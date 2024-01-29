<?php include('include/config.php');

$conn = new mysqli($host, $username, $password, $database);
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RT-09</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./asset/images/logo-dki-512.png">
    <!-- Custom Stylesheet -->
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <link href="./asset/css/style.css" rel="stylesheet">
    <link href="./asset/css/style2.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="./asset/plugins/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    <link href="./asset/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="./asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        rel="stylesheet">

    <link href="./asset/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="./asset/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="./asset/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->

    <link href="./asset/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
</head>