<?php
require __DIR__ . '/config.php';

try {
    // Optional POST/GET hybrid for convenience
    $input = $_SERVER['REQUEST_METHOD'] === 'POST'
        ? read_json()
        : $_GET;

    $db = db();

    // Optional filters
    $task_id = isset($input['task_id']) ? validate_id($input['task_id'], 'task_id') : null;
    $status  = isset($input['status'])  ? trim($input['status']) : null;

    $validStatuses = ['new', 'in_progress', 'completed', 'blocked'];
    if ($status && !in_array($status, $validStatuses, true)) {
        throw new InvalidArgumentException("Invalid status filter");
    }

    // Build query dynamically
    $where = [];
    $params = [];

    if ($task_id) {
        $where[] = 's.task_id = :task_id';
        $params[':task_id'] = $task_id;
    }
    if ($status) {
        $where[] = 's.status = :status';
        $params[':status'] = $status;
    }

    $sql = "
        SELECT 
            s.id,
            s.name,
            s.description,
            s.duedate,
            s.status,
            s.worker_id,
            w.id AS worker_id,
            u.full_name AS worker_name,
            u.email AS worker_email,
            s.task_id
        FROM subtask s
        LEFT JOIN worker w ON s.worker_id = w.id
        LEFT JOIN user u ON w.user_id = u.id
    ";

    if ($where) {
        $sql .= ' WHERE ' . implode(' AND ', $where);
    }

    $sql .= ' ORDER BY s.duedate ASC, s.id ASC';
    $st = $db->prepare($sql);
    $st->execute($params);
    $rows = $st->fetchAll();

    // If task_id provided, compute progress summary
    $summary = null;
    if ($task_id) {
        $q = $db->prepare("
            SELECT 
                COUNT(*) AS total,
                SUM(status='completed') AS completed,
                SUM(status='in_progress') AS in_progress,
                SUM(status='blocked') AS blocked,
                SUM(status='new') AS new_tasks
            FROM subtask WHERE task_id = ?");
        $q->execute([$task_id]);
        $summary = $q->fetch();
        $summary['progress_percent'] = $summary['total'] > 0
            ? round(($summary['completed'] / $summary['total']) * 100, 1)
            : 0;
    }

    echo json_encode([
        'ok' => true,
        'count' => count($rows),
        'summary' => $summary,
        'subtasks' => $rows
    ], JSON_PRETTY_PRINT);

} catch (InvalidArgumentException $e) {
    error_response($e, 422);
} catch (Throwable $e) {
    error_response($e, 500);
}
