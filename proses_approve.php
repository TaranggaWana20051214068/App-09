<?php
include("include/config.php");

$response = array();

if (isset($_GET["ket"])) {
    $ket = $_GET["ket"];

    if ($ket == 'approve') {
        $id = $_GET['id'];
        $user_id = $_GET['user_id'];
        $status = 'Di Setujui';

        $query = "UPDATE tbl_surat SET acc = 100, status = '$status', user_id = '$user_id' WHERE id = ?";
    } else if ($ket == 'alamat') {
        $telp = $_GET["telp"];
        $alamat = $_GET['alamat'];
        $id = $_GET['id'];

        // Menggunakan parameterized query untuk menghindari SQL injection
        $query = "UPDATE tbl_users SET telp = ?, alamat = ? WHERE user_id = ?";
    }

    if (isset($query)) {
        $stmt = mysqli_prepare($conn, $query);

        if ($ket == 'approve') {
            // Bind parameter untuk parameterized query
            mysqli_stmt_bind_param($stmt, 'i', $id);
        } else if ($ket == 'alamat') {
            // Bind parameter untuk parameterized query
            mysqli_stmt_bind_param($stmt, 'isi', $telp, $alamat, $id);
        }

        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        mysqli_stmt_close($stmt);
    } else {
        $response['success'] = false;
    }
} else {
    $response['success'] = false;
}

echo json_encode($response);
mysqli_close($conn);