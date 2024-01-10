<?php
include("include/config.php");

$id = $_GET['id'];
$status = 'Di Setujui';

$query = "UPDATE tbl_surat SET acc = 100, status = '$status' WHERE id = $id";

$response = array();
if (mysqli_query($conn, $query)) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>