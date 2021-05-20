<?php session_start();

require_once "../db_config/db.php";

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json;charset=utf-8");

$userData = json_decode($_POST["userData"], true);
$id = $userData["id"];

$statement = $pdo->prepare("SELECT edit_log.editor_id, edit_log.edit_time, edit_log.point_value, edit_log.id, users.name, users.rank
    FROM edit_log
    INNER JOIN point_log ON point_log.edit_action_id = edit_log.id
    INNER JOIN users ON users.id = edit_log.editor_id
    WHERE point_log.recipient_id = :id");
$statement->execute(["id" => $id]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);