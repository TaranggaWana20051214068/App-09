<?php

$i = $_GET['id'];
//echo $i;
@session_start();
$tableDet = $_SESSION["tableDet"];

if ($tableDet == TRUE) {
    $tableDet[$i]["i"] = "del";
    $_SESSION["tableDet"] = $tableDet;
}

header("Location: ./?page=add");
die();
?>