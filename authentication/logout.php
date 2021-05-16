<?php session_start();

include "db.php";

$response = [
    "logout" => false,
    "error" => false
];

if (!isset($_SESSION["authenticated"]))
{
    $response["error"] = true;
    echo json_encode($response);
    die();
}

if ($_SESSION["authenticated"])
{
    $_SESSION = array();

    if (ini_get("session.use_cookies"))
    {
        $params = session_get_cookie_params();
        setcookie(session_name(), "", time() - 42000, $params["path"],
            $params["domain"], $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    $response["logout"] = true;
}

echo json_encode($response);