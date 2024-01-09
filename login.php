<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: ./');
    die();
}

require_once("include/config.php");
require_once("vendor/autoload.php");

$client_id = "690718480185-b8tgufpfbnujabma1l1o1f03srk3h95r.apps.googleusercontent.com";
$client_secret = "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";
$redirect_url = "http://localhost:8000/login.php";

// inisiasi google acount
$client = new google_client();

$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_url);
$client->setScopes(array("email", "profile"));

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        // inisiate google service oauth2
        $service = new Google_Service_Oauth2($client);
        $profile = $service->userinfo->get();

        $g_name = $profile['name'];
        $g_email = $profile['email'];
        $g_id = $profile['id'];
        $g_profile_picture_url = $profile['picture'];
        $role = 101;
        $query_check = mysqli_prepare($conn, "SELECT full_name,email,oauth_id FROM tbl_users WHERE oauth_id = ?");
        mysqli_stmt_bind_param($query_check, 's', $g_id);
        mysqli_stmt_execute($query_check);
        $result_check = mysqli_stmt_get_result($query_check);
        $row = mysqli_fetch_assoc($result_check);

        if (mysqli_num_rows($result_check) > 0) {
            // User exists
            if ($row['role'] == 0) {
                $query_update_porfile = mysqli_query($conn, "UPDATE tbl_users SET role = '$role' WHERE oauth_id = '$g_id'");
            }
            if ($row['file'] == null) {
                $query_update_porfile = mysqli_query($conn, "UPDATE tbl_users SET file = '$g_profile_picture_url' WHERE oauth_id = '$g_id'");
            }
            if ($row['full_name'] == $g_name || $row['email'] == $g_email) {
                $query_update = mysqli_prepare($conn, "UPDATE tbl_users SET full_name=?, email=?, last_login=NOW() WHERE oauth_id=?");
                mysqli_stmt_bind_param($query_update, 'ssi', $g_name, $g_email, $g_id);
                mysqli_stmt_execute($query_update);
            } else {
                $query_update = mysqli_query($conn, "UPDATE tbl_users SET last_login = NOW() WHERE oauth_id = '$g_id'");
            }
            if ($query_update === false) {
                die('Update Error: ' . mysqli_error($conn));
            }
        } else {
            $query_insert = mysqli_prepare($conn, "INSERT INTO tbl_users (full_name, email, oauth_id, foto, lvl) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($query_insert, 'ssssi', $g_name, $g_email, $g_id, $g_profile_picture_url, $role);
            mysqli_stmt_execute($query_insert);
            if ($query_insert === false) {
                die('Insert Error: ' . mysqli_error($conn));
            }
        }
        if ($query_check === false) {
            die('Query Error: ' . mysqli_error($conn));
        }


        $_SESSION['login'] = true;
        $_SESSION['access_token'] = $token['access_token'];
        $_SESSION['uname'] = $g_name;
        $_SESSION['email'] = $g_email;
        $_SESSION['oauth_id'] = $g_id;
        $_SESSION['p_foto'] = $g_profile_picture_url;
        header("Location: ./");
    }
}
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .gsi-material-button {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -webkit-appearance: none;
            background-color: WHITE;
            background-image: none;
            border: 1px solid #747775;
            -webkit-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            color: #1f1f1f;
            cursor: pointer;
            font-family: 'Roboto', arial, sans-serif;
            font-size: 14px;
            height: 40px;
            letter-spacing: 0.25px;
            outline: none;
            overflow: hidden;
            padding: 0 12px;
            position: relative;
            text-align: center;
            -webkit-transition: background-color .218s, border-color .218s, box-shadow .218s;
            transition: background-color .218s, border-color .218s, box-shadow .218s;
            vertical-align: middle;
            white-space: nowrap;
            width: auto;
            min-width: min-content;
        }

        .gsi-material-button .gsi-material-button-icon {
            height: 20px;
            margin-right: 12px;
            min-width: 20px;
            width: 20px;
        }

        .gsi-material-button .gsi-material-button-content-wrapper {
            -webkit-align-items: center;
            align-items: center;
            display: flex;
            -webkit-flex-direction: row;
            flex-direction: row;
            -webkit-flex-wrap: nowrap;
            flex-wrap: nowrap;
            height: 100%;
            justify-content: space-between;
            position: relative;
            width: 100%;
        }

        .gsi-material-button .gsi-material-button-contents {
            -webkit-flex-grow: 1;
            flex-grow: 1;
            font-family: 'Roboto', arial, sans-serif;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: top;
        }

        .gsi-material-button .gsi-material-button-state {
            -webkit-transition: opacity .218s;
            transition: opacity .218s;
            bottom: 0;
            left: 0;
            opacity: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        .gsi-material-button:disabled {
            cursor: default;
            background-color: #ffffff61;
            border-color: #1f1f1f1f;
        }

        .gsi-material-button:disabled .gsi-material-button-contents {
            opacity: 38%;
        }

        .gsi-material-button:disabled .gsi-material-button-icon {
            opacity: 38%;
        }

        .gsi-material-button:not(:disabled):active .gsi-material-button-state,
        .gsi-material-button:not(:disabled):focus .gsi-material-button-state {
            background-color: #303030;
            opacity: 12%;
        }

        .gsi-material-button:not(:disabled):hover {
            -webkit-box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
        }

        .gsi-material-button:not(:disabled):hover .gsi-material-button-state {
            background-color: #303030;
            opacity: 8%;
        }
    </style>
</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->





    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <?php
                                if (isset($token['error'])) {
                                    echo '<div class="alert alert-danger">Login Gagal. Please Try Again</div>';
                                }
                                if (isset($_SESSION["timeOut"]) && $_SESSION["timeOut"]) {
                                    echo '<div id="hapus" class="alert alert-danger">' . $_SESSION['timeOut'] . '</div>';
                                    unset($_SESSION['timeOut']);
                                }
                                ?>
                                <a class="text-center" href="javascript:void()">
                                    <h4>Login</h4>
                                </a>
                                <form class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                                <button class="gsi-material-button w-100 submit btn"
                                    onclick="window.location.href='<?= $client->createAuthUrl(); ?>'">
                                    <div class="gsi-material-button-state"></div>
                                    <div class="gsi-material-button-content-wrapper">
                                        <div class="gsi-material-button-icon">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                                                <path fill="#EA4335"
                                                    d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z">
                                                </path>
                                                <path fill="#4285F4"
                                                    d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z">
                                                </path>
                                                <path fill="#FBBC05"
                                                    d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z">
                                                </path>
                                                <path fill="#34A853"
                                                    d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z">
                                                </path>
                                                <path fill="none" d="M0 0h48v48H0z"></path>
                                            </svg>
                                        </div>
                                        <span class="gsi-material-button-contents">Sign in with Google</span>
                                        <span style="display: none;">Sign in with Google</span>
                                    </div>
                                </button>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="register.php"
                                        class="text-primary">Sign Up</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    <script>setTimeout(function () {
            var successMessage = document.getElementById("hapus");
            successMessage.style.display = "none";
        }, 5000); // 3000 milidetik atau 3 detik</script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>

</html>