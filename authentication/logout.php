<?php session_start();

require_once "../db_config/db.php";

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json;charset=utf-8");

$response = [
    "logout" => false
];

$_SESSION = [];
session_destroy();
$response["logout"] = true;


echo json_encode($response);