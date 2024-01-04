<?php

$i = $_GET['id'];
$page = $_GET['ect'];
//echo $i;
@session_start();
$tableDet = $_SESSION["tableDet"];

if ($tableDet == TRUE) {
    $tableDet[$i]["i"] = "del";
    $_SESSION["tableDet"] = $tableDet;
}
if ($tableDet[$i]['page'] != "edit") {
    header("Location: ./?page=add");
    die();
} else {
    header("Location: ./?page=edit&id=" . $tableDet[$i]["id"] . "");
    die();
}
?>