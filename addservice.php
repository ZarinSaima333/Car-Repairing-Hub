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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><?php echo $Data['id'] ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="shopOwner.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card card-body">
                        <form role="form" enctype="multipart/form-data" method="post" action="addservice.php">

                            <div class="form-group">
                                <label style="font-size: larger;">Service Name:</label>
                                <input autocomplete="off" type="text" class="form-control" name="service_name">
                            </div><br>

                            <div class="form-group">
                                <label style="font-size: larger;">Shop ID:</label>
                                <input type="int" class="form-control" name="shop_id">
                            </div><br>

                            <div class="form-group">
                                <label style="font-size: larger;">Service Cost:</label>
                                <input type="text" class="form-control" name="service_cost">
                            </div><br>

                            <div class="d-flex justify-content-center gap-3 mb-2 pb-3">
                                <input type="submit" class="btn btn-outline-success btn-rounded fs-5 my-auto " value="Add Service" />
                            </div>

                        </form><br>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Add service logic
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['service_name']) && isset($_POST['shop_id']) && isset($_POST['service_cost'])) {
                $service_name = $_POST['service_name'];
                $shop_id = $_POST['shop_id'];
                $service_cost = $_POST['service_cost'];

                // Insert into the database (Replace this with your actual database connection and insertion logic)
                $insertQuery = "INSERT INTO offered_services (service_name, shop_id, service_cost) VALUES ('$service_name', '$shop_id', '$service_cost')";
                
                // Execute the query (Replace $conn with your actual database connection variable)
                $insertResult = mysqli_query($conn, $insertQuery);

                if ($insertResult) {
                    echo "<script>window.location.href='watchservice.php'</script>";
                } else {
                    echo "<script>alert('Error adding service');</script>";
                }
            }
        }
        ?>

        <footer style="background-color:#000000 ;">
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
                                        <p class="mt-1 fs-5 fw-normal"><small>copyrightÂ©carrepairinghub2022</small></p>
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