<?php session_start();

require_once "../db_config/db.php";

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json;charset=utf-8");

$response = [
    "authenticated" => false
];

if ($_SESSION["authenticated"])
{
    $response["authenticated"] = true;
    $response["user_id"] = $_SESSION["user_id"];
}

echo json_encode($response);