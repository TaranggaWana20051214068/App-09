<?php
if (!isset($_SESSION['login'])) {
    $_SESSION['timeOut'] = 'Silahkan Login Kembali';
    header('Location: login.php');
    die();
}
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM tbl_users WHERE user_id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <img class="mr-3 rounded-circle" src="<?= $row['foto'] ?>" width="80" height="80" alt="">
                        <div class="media-body">
                            <h4 class="mb-1">
                                <?= $row['full_name'] ?>
                            </h4>
                            <p class="text-muted mb-0 address">
                                <?= ($row['alamat']) ? $row['alamat'] : '<span class="text-warning" >Kosong</span>' ?>
                            </p>
                        </div>
                    </div>

                    <!-- <div class="row mb-5">
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted px-4">Following</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted">Followers</p>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-danger px-5">Follow Now</button>
                            </div>
                        </div> -->

                    <ul class="card-profile__info">
                        <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong><span>
                                <?= ($row['telp']) ? $row['telp'] : '<span class="text-warning" >Kosong</span>' ?>
                            </span>
                        </li>
                        <li class="mb-1"><strong class="text-dark mr-4">Email</strong> <span>
                                <?= $row['email'] ?>
                            </span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="card">
                    <div class="card-body">
                        <div class="media media-reply">
                            <img class="mr-3 circle-rounded" src="images/avatar/2.jpg" width="50" height="50"
                                alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="d-sm-flex justify-content-between mb-2">
                                    <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days
                                            ago</small></h5>
                                    <div class="media-reply__link">
                                        <button class="btn btn-transparent p-0 mr-3"><i
                                                class="fa fa-thumbs-up"></i></button>
                                        <button class="btn btn-transparent p-0 mr-3"><i
                                                class="fa fa-thumbs-down"></i></button>
                                        <button
                                            class="btn btn-transparent text-dark font-weight-bold p-0 ml-2">Reply</button>
                                    </div>
                                </div>

                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                    sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                                    Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in
                                    faucibus.</p>
                                <ul>
                                    <li class="d-inline-block"><img class="rounded" width="60" height="60"
                                            src="images/blog/2.jpg" alt=""></li>
                                    <li class="d-inline-block"><img class="rounded" width="60" height="60"
                                            src="images/blog/3.jpg" alt=""></li>
                                    <li class="d-inline-block"><img class="rounded" width="60" height="60"
                                            src="images/blog/4.jpg" alt=""></li>
                                    <li class="d-inline-block"><img class="rounded" width="60" height="60"
                                            src="images/blog/1.jpg" alt=""></li>
                                </ul>

                                <div class="media mt-3">
                                    <img class="mr-3 circle-rounded circle-rounded" src="images/avatar/4.jpg" width="50"
                                        height="50" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <div class="d-sm-flex justify-content-between mb-2">
                                            <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days
                                                    ago</small></h5>
                                            <div class="media-reply__link">
                                                <button class="btn btn-transparent p-0 mr-3"><i
                                                        class="fa fa-thumbs-up"></i></button>
                                                <button class="btn btn-transparent p-0 mr-3"><i
                                                        class="fa fa-thumbs-down"></i></button>
                                                <button
                                                    class="btn btn-transparent p-0 ml-3 font-weight-bold">Reply</button>
                                            </div>
                                        </div>
                                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                            sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                            turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                                            congue felis in faucibus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="media media-reply">
                            <img class="mr-3 circle-rounded" src="images/avatar/2.jpg" width="50" height="50"
                                alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="d-sm-flex justify-content-between mb-2">
                                    <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days
                                            ago</small></h5>
                                    <div class="media-reply__link">
                                        <button class="btn btn-transparent p-0 mr-3"><i
                                                class="fa fa-thumbs-up"></i></button>
                                        <button class="btn btn-transparent p-0 mr-3"><i
                                                class="fa fa-thumbs-down"></i></button>
                                        <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Reply</button>
                                    </div>
                                </div>

                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                    sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                                    Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in
                                    faucibus.</p>
                            </div>
                        </div>

                        <div class="media media-reply">
                            <img class="mr-3 circle-rounded" src="images/avatar/2.jpg" width="50" height="50"
                                alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="d-sm-flex justify-content-between mb-2">
                                    <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days
                                            ago</small></h5>
                                    <div class="media-reply__link">
                                        <button class="btn btn-transparent p-0 mr-3"><i
                                                class="fa fa-thumbs-up"></i></button>
                                        <button class="btn btn-transparent p-0 mr-3"><i
                                                class="fa fa-thumbs-down"></i></button>
                                        <button class="btn btn-transparent p-0 ml-3 font-weight-bold">Reply</button>
                                    </div>
                                </div>

                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                    sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                                    Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in
                                    faucibus.</p>
                            </div>
                        </div>
                    </div>
                </div> -->