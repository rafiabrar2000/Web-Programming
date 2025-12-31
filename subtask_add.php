<?php
require __DIR__ . '/config.php';

try {
    $in = read_json();
    $db = db();

    $task_id = validate_id($in['task_id'] ?? null, 'task_id');
    check_task_exists($db, $task_id);
    $name = validate_name($in['name'] ?? null);
    $duedate = validate_date($in['duedate'] ?? null);
    $description = validate_description($in['description'] ?? null);

    $worker_id = null;
    if (!empty($in['worker_id'])) {
        $worker_id = validate_id($in['worker_id'], 'worker_id');
        check_worker_exists($db, $worker_id);
    } elseif (!empty($in['worker_email'])) {
        $worker_id = find_worker_by_email($db, $in['worker_email']);
    }

    $status = 'new';

    $db->beginTransaction();
    $sql = "INSERT INTO subtask (name, duedate, task_id, worker_id, status, description)
            VALUES (:name,:duedate,:task_id,:worker_id,:status,:description)";
    $st = $db->prepare($sql);
    $st->execute([
        ':name' => $name,
        ':duedate' => $duedate,
        ':task_id' => $task_id,
        ':worker_id' => $worker_id,
        ':status' => $status,
        ':description' => $description
    ]);
    $id = (int)$db->lastInsertId();
    update_task_status($db, $task_id);
    $db->commit();

    echo json_encode(['ok' => true, 'subtask_id' => $id]);
} catch (InvalidArgumentException $e) {
    if (db()->inTransaction()) db()->rollBack();
    error_response($e, 422);
} catch (Throwable $e) {
    if (db()->inTransaction()) db()->rollBack();
    error_response($e, 500);
}
