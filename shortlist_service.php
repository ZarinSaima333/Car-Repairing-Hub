<?php require_once('dbconnect.php');
session_start();
if (empty($_SESSION)) {
    session_unset();
    session_destroy();
}
?>
<!DOCTYPE html>

<body lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Car Reparing Hub </title>

        <!-- stylesheet -->
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
                            <?php if (session_status() === PHP_SESSION_ACTIVE) {
                        
                            ?>
                                <?php
                                $Data = $_SESSION['user_data'];
                                if ($Data['type'] !== null && $Data['type'] == 'customer') {
                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><?php echo $Data['id'] ?></a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="custprofile.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="cartnew.php"> Selected Services</a></li>
                                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                        </ul>
                                    </li>
                                <?php
                                    $Data = $_SESSION['user_data'];
                                } elseif ($Data['type'] !== null && $Data['type'] == 'shop owner') {
                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><?php echo $Data['id'] ?></a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="Shop_owner.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                        </ul>
                                    </li>
                                <?php
                                    $Data = $_SESSION['user_data'];
                                } elseif ($Data['type'] !== null && $Data['type'] == 'admin') {
                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><?php echo $Data['id'] ?></a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="custprofile.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>
                            <?php
                            } else {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link active" href="signin.php">Log in</a>
                                </li>
                            <?php
                            }
                            ?>


                        </ul>
                    </div>
                </div>
            </nav>
        </header>


        <?php
        if (isset($_GET['service_name'])) {
            $service_name = $_GET['service_name'];

            // Define the SQL query
            $sql = "SELECT shops.shop_id, shops.shop_name, offered_services.service_name,offered_services.service_cost, shops.road, shops.area, shops.city, shops.phone, shops.hours, AVG(rate.rating) as rating FROM ((Offered_services INNER JOIN shops ON offered_services.shop_id=shops.shop_id) LEFT JOIN rate ON rate.shop_id=offered_services.shop_id)  WHERE offered_services.service_name='$service_name' GROUP BY rate.shop_id";



            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Check for errors
            if (!$result) {
                die("Error: " . mysqli_error($conn));
            }

            // Check if there are rows in the result
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='text-center'>";
                echo "<h2 class='mt-4'>$service_name</h2>";
                echo "<p> </p>";
                echo "</div>";

                while ($row = mysqli_fetch_array($result)) {

        ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="cart">
                                    <div class="services">
                                        <div class="row border">
                                            <div class="col-md-2 col-sm-2 mt-2"></div>
                                            <div class="col-md-7 col-sm-7 mt-1 fw-bold">

                                                <h3><?php echo $row['shop_name']; ?></h3>
                                                <p>Address: <?php echo $row['road'], ", ", $row['area'], ", ", $row['city']; ?></p>
                                                <p>Phone: <?php echo $row['phone']; ?></p>
                                                <p>Hours: <?php echo $row['hours']; ?></p>
                                                <p>Rating: <?php echo $ratings = number_format($row['rating'], 1); ?></p>
                                                <h5 class="fw-normal">BDT <?php echo $row['service_cost']; ?></h5>
                                                <?php
                                                if ((session_status() === PHP_SESSION_ACTIVE) && ($Data['type'] == 'customer')) {
                                                ?>
                                                    <form action="shortlist_service.php" method="GET">

                                                        <input type="hidden" name="customer_id" value="<?php echo $Data['id'] ?>">
                                                        <input type="hidden" name="shop_id" value="<?php echo $row['shop_id'] ?>">
                                                        <input type="hidden" name="service_name" value="<?php echo $row['service_name'] ?>">
                                                        <button type="submit" style="background-color:#4CAF50;border: none; border-radius: 5px;color: white;">Add Service</button>
                                                    </form>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></br>
        <?php
                }
            } else {
                echo "No Shop offers this service";
            }
        } else {
            echo "No service_name parameter";
        }


        ?>


        <!-- PHP CODE & SQL COMMANDS FOR ADDING THE SELECTED ITEM-->
        <?php

        if (isset($_GET['customer_id']) && isset($_GET['shop_id']) && isset($_GET['service_name'])) {
            $customer_id = $_GET['customer_id'];
            $shop_id = $_GET['shop_id'];
            $service_name = $_GET['service_name'];
            $sql1 = "INSERT INTO `selects`(`customer_id`, `shop_id`, `service_name`) VALUES ('$customer_id','$shop_id','$service_name')";

            $result = mysqli_query($conn, $sql1);
            if (!$result) {
                // Query execution failed
                echo "Already Added";
            }

            if (mysqli_affected_rows($conn)) {
                echo "<script>window.location.href='cartnew.php'</script>";
            } else {
                echo '<p style="text-align:center;transition-duration: 3s">This service is already added!</p>';
            }
        }

        ?>

 

        <footer class='mt-4' style="background-color:#000000 ;width: 100%;">
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