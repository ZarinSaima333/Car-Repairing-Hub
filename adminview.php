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

        <div class="container fs-4 py-4" style="background-color: #e8fafb ; ">
            <p class="text-center text-success" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-weight: bold;">
                ADMIN VIEW</br>

            </p>
        </div></br>

     <!-- SHOWING CUSTOMER DETAILS    -->
        <h4 style="text-align:center">Customer Details</h4>
        <div style="margin-left:50px; margin-right:50px; margin-bottom:50px;text-align:center;background:paleturquoise;font-size:larger">
            <div class="row" style="padding:5px;">
                <div class="col-md-1" style="color:indigo;font-weight:bold"> User ID</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Name </div>
                <div class="col-md-3" style="color:indigo;font-weight:bold"> Address </div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Email</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Phone</div>

            </div><hr>
            <!-- PHP CODE & SQL COMMANDS FOR SHOWING CUSTOMER DETAILS-->
            <?php

            $sql = "SELECT * FROM user WHERE user_type='customer'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

            ?>
                    <div class="row" style="padding:5px;;text-align:center;font-size:medium">
                        <div class="col-md-1"><?php echo $row[0]; ?></div>
                        <div class="col-md-2"><?php echo $row[1]; ?></div>
                        <div class="col-md-3"><?php echo $row[2] . ', ' . $row[3] . ', ' . $row[4]; ?></div>
                        <div class="col-md-2"><?php echo $row[5]; ?></div>
                        <div class="col-md-2"><?php echo $row[6]; ?></div>
                        <div class="col-md-2">
                            <a href="admincustview.php?id=<?php echo $row[0]; ?>">
                                <button style="background-color:mediumslateblue;border: none; border-radius: 5px;color: white;">Show More</button>
                            </a>
                        </div>

                    </div><hr>


            <?php
                }
            }
            ?>
        </div>


    <!-- SHOP OWNER DETAILS PART -->
        <h4 style="text-align:center">Shop Owners Details</h4>
        <div style="margin-left:50px; margin-right:50px; margin-bottom:50px;text-align:center;background:paleturquoise;font-size:larger">
            <div class="row" style="padding:5px;">
                <div class="col-md-2" style="color:indigo;font-weight:bold"> User ID</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Name </div>
                <div class="col-md-4" style="color:indigo;font-weight:bold"> Address </div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Email</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Phone</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Phone</div>

            </div><hr>
    <!-- PHP CODE & SQL COMMANDS FOR SHOWING SHOP OWNER DETAILS-->
            <?php

            $sql = "SELECT * FROM user WHERE user_type='shop owner'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

            ?>
                    <div class="row" style="padding:5px;;text-align:center;font-size:medium">
                        <div class="col-md-2"><?php echo $row[0]; ?></div>
                        <div class="col-md-2"><?php echo $row[1]; ?></div>
                        <div class="col-md-4"><?php echo $row[2] . ', ' . $row[3] . ', ' . $row[4]; ?></div>
                        <div class="col-md-2"><?php echo $row[5]; ?></div>
                        <div class="col-md-2"><?php echo $row[6]; ?></div>

                    </div><hr>


            <?php
                }
            }
            ?>
        </div>


<!-- SHOP Details PART -->
        <h4 style="text-align:center">Shop Details</h4>
        <div style="margin-left:50px; margin-right:50px;margin-bottom:50px;text-align:center;background:paleturquoise;font-size:larger">
            <div class="row" style="padding:5px">
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Shop ID</div>
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Shop Name </div>
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Owner ID </div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> Address </div>
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Phone</div>
                <div class="col-md-2" style="color:indigo;font-weight:bold"> License No</div>
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Total Sell(BDT)</div>
                <div class="col-md-1" style="color:indigo;font-weight:bold"> Rating(AVG)</div>
                <div class="col-md-1" style="color:indigo;font-weight:bold"></div>
            </div><hr>
<!-- PHP CODE & SQL COMMANDS FOR SHOWING SHOP  DETAILS-->
            <?php

            $sql = "SELECT shops.shop_id, shops.shop_name,shops.owner_id,shops.road,shops.area,shops.city,shops.phone,shop_owner.license_no, SUM(payment_details.total_paid),AVG(rate.rating) FROM (((shops INNER JOIN shop_owner ON shops.owner_id=shop_owner.owner_id) LEFT JOIN rate ON rate.shop_id=shops.shop_id) LEFT JOIN payment_details ON payment_details.shop_id=shops.shop_id) GROUP BY shops.shop_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

            ?>
                    <div class="row" style="padding:5px;;text-align:center;font-size:medium">
                        <div class="col-md-1"><?php echo $row[0]; ?></div>
                        <div class="col-md-1"><?php echo $row[1]; ?></div>
                        <div class="col-md-1"><?php echo $row[2]; ?></div>
                        <div class="col-md-2"><?php echo $row[3] . ', ' . $row[4] . ', ' . $row[5]; ?></div>
                        <div class="col-md-1"><?php echo $row[6]; ?></div>
                        <div class="col-md-2"><?php echo $row[7]; ?></div>
                        <div class="col-md-1"><?php echo $total=number_format($row[8],0); ?></div>
                        <div class="col-md-1"><?php echo $rating=number_format($row[9],1); ?></div>
                        <div class="col-md-2">
                            <a href="adminshopview.php?id=<?php echo $row[0]; ?>">
                                <button style="background-color:mediumslateblue;border: none; border-radius: 5px;color: white;">Show More</button>
                            </a>
                        </div>

                    </div><hr>
            <?php
                }
            }
            ?>
        </div>


<!-- PHP CODE & SQL COMMAND TO DELETE SHOP -->
        <?php
        if (isset($_GET['id'])) {
            $shop = $_GET['id'];
            $sql = "DELETE FROM shops WHERE shop_id = '$shop'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn)) {

                echo "<script>window.location.href='adminview.php'</script>";
            }
        }
        ?>


        <!----- Footer ----->
        <section id="footer">
            <script src="js/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.isotope.min.js"></script>
            <script src="js/wow.min.js"></script>
        </section>
    </body>

    </html>