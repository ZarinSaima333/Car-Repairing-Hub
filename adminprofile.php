<?php require_once('dbconnect.php');
session_start();
$Data = $_SESSION['user_data'];
?>
<!DOCTYPE html>

<body lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Car Reparing Hub </title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #398D7F;">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center fs-5 fw-bold" href="#"><img src="https://media.discordapp.net/attachments/939266966265417768/1053518288396767262/logo.png" alt="" width="50" height="50" class="d-inline-block align-text-top rounded-circle"><span class="ms-2 font-weight-bold">Car Reparing Hub</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse fs-6 fw-semibold " id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0  d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="service.php">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="aboutus.php">About Us</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><?php echo "admin" .$Data['id'] ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="adminprofile.php">Profile</a></li>
                                    
                                    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </header></br></br>

        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://www.shutterstock.com/image-vector/user-icon-vector-600nw-393536320.jpg" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?php echo $Data['id'] ?></h4>
                                        <p class="text-secondary mb-1">Admin Profile</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><a href="changepassword.php">Change Password</a></h6>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><a href="changenum.php">Change Phone Number</a></h6>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><a href="changeaddress.php">Change Address</a></h6>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <!-- PHP CODE $ SQL COMMANS TO SHOW THE CUSTOMER'S PROFILE -->
                    <?php
                    $customer_id = $Data['id'];
                    $sql = "SELECT * FROM `user` WHERE user_id=$customer_id;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_array($result)) {

                    ?>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">User ID:</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <h6 class="mb-0"><?php echo $row[0]; ?></h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <h6 class="mb-0"><?php echo $row[1]; ?></h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <h6 class="mb-0"><?php echo $row[2] . ", " . $row[3] . ", " . $row[4]; ?></h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <h6 class="mb-0"><?php echo $row[5]; ?></h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <h6 class="mb-0"><?php echo $row[6]; ?></h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <h6 class="mb-0"><?php echo $row[7]; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p style="text-align:center"><a href="adminview.php" class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" role="button">Watch Details</a>
                                <a href="admineditser.php" class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" role="button">Edit Services</a></p>
                    <?php
                        }
                    }
                    ?>
                            </div>
                </div>
            </div>
        </div></br></br></br></br></br>
    </body>

    <footer class='mt-4' style="background-color:#000000 ; position: fixed;bottom: 0;width: 100%;">
            <div>
                <div>
                    <div class="footer-container text-light">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="left-container text-start mt-3">
                                        <h3>Car Reparing Hub</h3>
                                        <div class="icons-container d-flex text-center ">
                                            <div class="icon d-flex gap-4 mb-1"><i class="fab fa-facebook" aria-hidden="true"></i><i class="fab fa-instagram" aria-hidden="true"></i><i class="fab fa-twitter" aria-hidden="true"></i><i class="fab fa-youtube" aria-hidden="true"></i></div>
                                        </div>
                                        <p class="mt-1 fs-5 fw-normal"><small>copyrightÂ©carrepairinghub2023</small></p>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <div class="right-footer-container mt-4 fs-6 align-items-center gap-2 d-flex justify-content-center text-light ">
                                        <h5 class="pt-3">Your email:</h5><input class="footer-input mt-2" type="text" size="30" placeholder="Enter Email">
                                        <div class="phone d-flex align-items-center justify-content-center mt-4">
                                            <div class="foter-phone-icon"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>

    </html>