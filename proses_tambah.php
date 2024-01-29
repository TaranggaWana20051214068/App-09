<?php
include("include/config.php");

$response = array();

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data[0])) {
    $tbl = $data[0];

    // Kolom yang akan diisi diambil dari data JSON
    $surat = $data[1];
    $columnSurat = explode(', ', $surat);
    $columnSurat[] = "rt"; // Use [] to add "rt" to the array
// Membuat string kolom
    $columnNama = implode(', ', $columnSurat);
    // Mengisi nilai yang akan di-insert
    $valuesSurat = implode(', ', array_fill(0, count($columnSurat), '?'));
    $setVal = array();
    for ($i = 2; $i <= 4; $i++) {
        $setVal[] = $data[$i];
    }
    $paramSurat = array_merge($setVal, array($ketua_rt));
    $queryS = "INSERT INTO tbl_surat ($columnNama) VALUES ($valuesSurat)";
    $stmtS = mysqli_prepare($conn, $queryS);
    mysqli_stmt_bind_param($stmtS, str_repeat('s', count($columnSurat)), ...$paramSurat);

    if (mysqli_stmt_execute($stmtS)) {
        // Kolom yang akan diisi diambil dari data JSON
        $columnString = $data[5];
        $columns = explode(', ', $columnString);

        // Membuat string kolom
        $columnNames = implode(', ', $columns);

        // Mengisi nilai yang akan di-insert
        $valuesString = implode(', ', array_fill(0, count($columns), '?'));
        $setValues = array();
        for ($i = 6; $i < count($data); $i++) {
            $setValues[] = $data[$i];
        }
        $id_surat = $conn->insert_id;
        $params = array_merge($setValues, array($id_surat));

        // tbl_s_
        $query = "INSERT INTO $tbl ($columnNames) VALUES ($valuesString)";
        $stmt = mysqli_prepare($conn, $query);

        // Bind parameters

        mysqli_stmt_bind_param($stmt, str_repeat('s', count($columns)), ...$params);

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
}
echo json_encode($response);
mysqli_close($conn);