<?php
require __DIR__ . '/config.php';

try {
    $in = read_json();
    $db = db();

    $id = validate_id($in['id'] ?? null);
    $st = $db->prepare('SELECT task_id FROM subtask WHERE id=?');
    $st->execute([$id]);
    $r = $st->fetch();
    if (!$r) throw new InvalidArgumentException("Subtask not found");
    $task_id = (int)$r['task_id'];

    $db->beginTransaction();
    $del = $db->prepare('DELETE FROM subtask WHERE id=?');
    $del->execute([$id]);
    update_task_status($db, $task_id);
    $db->commit();

    echo json_encode(['ok' => true, 'deleted_id' => $id]);
} catch (InvalidArgumentException $e) {
    if (db()->inTransaction()) db()->rollBack();
    error_response($e, 422);
} catch (Throwable $e) {
    if (db()->inTransaction()) db()->rollBack();
    error_response($e, 500);
}
