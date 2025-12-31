<?php
require __DIR__ . '/config.php';

try {
    $in = read_json();
    $db = db();

    $id = validate_id($in['id'] ?? null, 'id');
    $note = validate_description($in['note'] ?? null);

    $db->beginTransaction();
    $st = $db->prepare('SELECT task_id, status FROM subtask WHERE id=? FOR UPDATE');
    $st->execute([$id]);
    $row = $st->fetch();
    if (!$row) throw new InvalidArgumentException("Subtask not found");
    $task_id = (int)$row['task_id'];

    if ($row['status'] !== 'completed') {
        $u = $db->prepare("UPDATE subtask SET status='completed' WHERE id=?");
        $u->execute([$id]);
    }

    // Optional: log into review table
    try {
        $db->query("SELECT 1 FROM review LIMIT 1");
        $ins = $db->prepare("INSERT INTO review (entity_type, entity_id, action, note, created_at)
                             VALUES ('subtask', ?, 'completed', ?, NOW())");
        $ins->execute([$id, $note]);
    } catch (Throwable $ignore) { }

    update_task_status($db, $task_id);
    $db->commit();

    echo json_encode(['ok' => true, 'completed_id' => $id]);
} catch (InvalidArgumentException $e) {
    if (db()->inTransaction()) db()->rollBack();
    error_response($e, 422);
} catch (Throwable $e) {
    if (db()->inTransaction()) db()->rollBack();
    error_response($e, 500);
}
