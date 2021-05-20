<?php session_start();

require_once "../db_config/db.php";

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json;charset=utf-8");

$userData = json_decode($_POST["userData"], true);
$id = $userData["id"];

$statement = $pdo->prepare("SELECT users.id, users.email, users.name, users.points FROM users WHERE id = :id");
$statement->execute(["id" => $id]);
$result = $statement->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);