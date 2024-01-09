<?php
session_start();
require_once("vendor/autoload.php");
if (isset($_SESSION["access_token"]) && $_SESSION['acces_token']) {
    $client = new Google_Client();
    $client->revokeToken($_SESSION['access_token']);
}
session_destroy();
header("Location: Login.php");
die();