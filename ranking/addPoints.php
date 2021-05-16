<?php session_start();

require_once "../db_config/db.php";

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json;charset=utf-8");

$response = [
    "success" => false
];

$userData = json_decode($_POST["userData"], true);
$points = $userData['points'];
$users = $userData['users'];

$statement= $pdo->prepare("INSERT INTO edit_log (editor_id, point_value) VALUES (?, ?)");
$statement->execute([$_SESSION['user_id'], $points]);
$editId = $pdo->lastInsertId();

foreach($users as $user)
{
    $statement= $pdo->prepare("UPDATE users SET points = points + ? WHERE id = ?");
    $statement->execute([$points, $user['id']]);

    $statement= $pdo->prepare("INSERT INTO point_log (edit_action_id, recipient_id) VALUES (?, ?)");
    $statement->execute([$editId, $user['id']]);
}

echo json_encode($response);