<?php
require __DIR__ . '/config.php';

try {
    $in = read_json();
    $db = db();

    $id = validate_id($in['id'] ?? null, 'id');
    $q = $db->prepare('SELECT task_id FROM subtask WHERE id=?');
    $q->execute([$id]);
    $row = $q->fetch();
    if (!$row) throw new InvalidArgumentException("Subtask not found");
    $task_id = (int)$row['task_id'];

    $fields = [];
    $params = [':id' => $id];

    if (isset($in['name'])) {
        $fields[] = 'name=:name';
        $params[':name'] = validate_name($in['name']);
    }
    if (isset($in['duedate'])) {
        $fields[] = 'duedate=:duedate';
        $params[':duedate'] = validate_date($in['duedate']);
    }
    if (isset($in['description'])) {
        $fields[] = 'description=:description';
        $params[':description'] = validate_description($in['description']);
    }
    if (isset($in['status'])) {
        $status = $in['status'];
        $valid = ['new', 'in_progress', 'completed', 'blocked'];
        if (!in_array($status, $valid, true))
            throw new InvalidArgumentException("Invalid status");
        $fields[] = 'status=:status';
        $params[':status'] = $status;
    }

    if (!empty($in['worker_id'])) {
        $wid = validate_id($in['worker_id'], 'worker_id');
        check_worker_exists($db, $wid);
        $fields[] = 'worker_id=:worker_id';
        $params[':worker_id'] = $wid;
    } elseif (!empty($in['worker_email'])) {
        $wid = find_worker_by_email($db, $in['worker_email']);
        $fields[] = 'worker_id=:worker_id';
        $params[':worker_id'] = $wid;
    }

    if (!$fields) throw new InvalidArgumentException("No valid fields provided");

    $db->beginTransaction();
    $sql = 'UPDATE subtask SET ' . implode(', ', $fields) . ' WHERE id=:id';
    $st = $db->prepare($sql);
    $st->execute($params);
    update_task_status($db, $task_id);
    $db->commit();

    echo json_encode(['ok' => true, 'updated_id' => $id]);
} catch (InvalidArgumentException $e) {
    if (db()->inTransaction()) db()->rollBack();
    error_response($e, 422);
} catch (Throwable $e) {
    if (db()->inTransaction()) db()->rollBack();
    error_response($e, 500);
}
