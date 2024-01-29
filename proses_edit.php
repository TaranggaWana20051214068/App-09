<?php
include("include/config.php");

$response = array();

$ket = $_GET['ket'];
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data[0], $data[1])) {
    $id = $data[0];
    $tbl = $data[1];

    $columnString = $data[2];
    $columns = explode(', ', $columnString);

    $updateValues = array();
    foreach ($columns as $column) {
        $updateValues[] = "$column = ?";
    }

    // Buat string SET dari array
    $setString = implode(', ', $updateValues);
    $setValues = array();
    for ($i = 3; $i < count($data); $i++) {
        $setValues[] = $data[$i];
    }



    $query = "UPDATE $tbl SET $setString WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    $params = array_merge($setValues, array($id));
    mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);

    if (mysqli_stmt_execute($stmt)) {
        $response['success'] = true;

    } else {
        $response['success'] = false;
        $response['error'] = mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    $response['success'] = false;
    $response['error'] = "Invalid request method";
}

echo json_encode($response);
mysqli_close($conn);
?>