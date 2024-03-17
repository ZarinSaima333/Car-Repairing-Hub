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
        <header style="width:100%">
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><?php echo "admin" . $Data['id'] ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="adminprofile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>


<!-- SHOW THE SERVED SERVICE HISTORY OF THAT SHOP -->
        <h4 style="text-align:center">HISTORY</h4>
        <div style="margin-left:50px; margin-right:50px;  margin-bottom:50px;text-align:center;background:beige;font-size:larger">
            <div class="row" style="padding:5px;">
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Payment ID</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Transaction Type</div>
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Shop ID</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Service</div>
                <div class="col-md-3" style="color:indigo;font-weight:bold"> Delivary Type</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> D/T</div>
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Charged</div>
            </div><hr>


<!-- PHP CODE & SQL COMMANDS SHOW THE HISTORY -->
            <?php
            $customer_id = $_GET['id'];
            $sql = "SELECT * FROM payment_details WHERE customer_id=$customer_id";

            
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

            ?>
                    <div class="row" style="padding:5px;;text-align:center;font-size:medium">
                        <div class="col-md-1"><?php echo $row[0]; ?></div>
                        <div class="col-md-2" style="text-transform:capitalize"><?php echo $row[1]; ?></div>
                        <div class="col-md-1"><?php echo $row[2]; ?></div>
                        <div class="col-md-2"><?php echo $row[3]; ?></div>
                        <div class="col-md-3" style="text-transform:capitalize"><?php echo $row[5]; ?></div>
                        <div class="col-md-2"><?php echo $row[6]; ?></div>
                        <div class="col-md-1"><?php echo $cost=number_format($row[7],0); ?></div>


                    </div><hr>
            <?php
                }
            } else {
                echo "NO HISTORY";
            }
            ?>
        </div></br>


<!-- SHOW THE REVIEW OF THAT SHOP -->
<h4 style="text-align:center">REVIEW(s)</h4>
        <div style="margin-left:50px; margin-right:50px;  margin-bottom:50px;text-align:center;background:lavenderblush;font-size:larger">
            <div class="row" style="padding:5px;">
                <div class="col-md-5" style="color:indigo;font-weight:bold"> Shop Name</div>
                <div class="col-md-5" style="color:indigo;font-weight:bold"> Review</div>
            </div><hr>


<!-- PHP CODE & SQL COMMANDS SHOW THE REVIEWS -->
            <?php
            $customer_id = $_GET['id'];
            $sql =  "SELECT shops.shop_name,reviews.review FROM reviews INNER JOIN shops on reviews.shop_id=shops.shop_id WHERE reviews.customer_id=$customer_id";

            
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

            ?>
                    <div class="row" style="padding:5px;;text-align:center;font-size:medium">
                        <div class="col-md-5"><?php echo $row[0]; ?></div>
                        <div class="col-md-5" style="text-transform:capitalize"><?php echo $row[1]; ?></div>


                    </div><hr>
            <?php
                }
            } else {
                echo "NO REVIEW(S)";
            }
            ?>
        </div></br>



<!-- SHOW THE RATING OF THAT SHOP -->
<h4 style="text-align:center">RATING(s)</h4>
        <div style="margin-left:50px; margin-right:50px;  margin-bottom:50px;text-align:center;background:lavenderblush;font-size:larger">
            <div class="row" style="padding:5px;">
                <div class="col-md-5" style="color:indigo;font-weight:bold"> Shop Name</div>
                <div class="col-md-5" style="color:indigo;font-weight:bold"> Rating</div>
            </div><hr>


<!-- PHP CODE & SQL COMMANDS SHOW THE REVIEWS -->
            <?php
            $customer_id = $_GET['id'];
            $sql =  "SELECT shops.shop_name,rate.rating FROM rate INNER JOIN shops on rate.shop_id=shops.shop_id WHERE rate.customer_id=$customer_id";

            
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

            ?>
                    <div class="row" style="padding:5px;;text-align:center;font-size:medium">
                        <div class="col-md-5"><?php echo $row[0]; ?></div>
                        <div class="col-md-5"><?php echo $row[1]; ?></div>


                    </div><hr>
            <?php
                }
            } else {
                echo "NO RATING(S)";
            }
            ?>
        </div></br>



       