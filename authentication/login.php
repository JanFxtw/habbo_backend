<?php session_start();

require_once "../db_config/db.php";

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json;charset=utf-8");

$response = [
    "authenticated" => false,
    "error" => false
];

$userData = json_decode($_POST["userData"], true);
$email = $userData["email"];

if (isset($_SESSION["authenticated"]))
{
    $_SESSION = [];
    session_destroy();
}

if (!strlen($userData["password"]))
{
    $response["error"] = true;
    echo json_encode($response);
    die();
}


$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$statement->execute(["email" => $email]);
$result = $statement->fetch(PDO::FETCH_ASSOC);

$password_valid = password_verify($userData["password"], $result["password"]);
if ($result && $password_valid)
{
    $_SESSION["authenticated"] = true;
    $_SESSION["user_id"] = $result["id"];

    $response["authenticated"] = true;
    $response['id'] = $result['id'];
    $response['name'] = $result['name'];
}
else
{
    $response["error"] = true;
}

echo json_encode($response);