<?php session_start();

require_once "../db_config/db.php";

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json;charset=utf-8");

$statement = $pdo->prepare("SELECT users.id, users.name FROM users ORDER BY points DESC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);