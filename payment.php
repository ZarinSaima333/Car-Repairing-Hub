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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><?php echo $Data['id'] ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="custprofile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="cartnew.php">Selected Services</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container fs-4 py-4" style="background-color: #e8fafb ; ">
            <p class="text-center text-success" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-weight: bold;">Service Availed Successfully!</p>
        </div>


        <!---------- PHP CODE & SQL COMMANDS TO DETAILS AFTER CONFIRMATION ---------->
        <?php
        $payment_id = $_GET['payment_id'];
        $shop_id = $_GET['shop_id'];
        $service_name = $_GET['service_name'];
        $id = $Data['id'];

        $sql = "SELECT payment_details.payment_id,payment_details.trans_type,payment_details.shop_id,shops.shop_name,payment_details.service_name,payment_details.customer_id,user.name,user.phone,payment_details.delivary_type,payment_details.date,
        payment_details.total_paid  from (payment_details INNER JOIN shops on shops.shop_id=payment_details.shop_id) INNER JOIN user on payment_details.customer_id=user.user_id WHERE payment_details.payment_id=$payment_id AND user.user_id=$id";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_array($result)) {

        ?>


        <!-- deleting the items from the cart after confirmation -->
                <?php
                $sql1 = "DELETE FROM selects WHERE shop_id = '$shop_id' AND service_name = '$service_name'";
                $result1 = mysqli_query($conn, $sql1);

                if (mysqli_affected_rows($conn)) {

                }

                ?>
                <table style="  margin-left: auto; margin-right: auto; background-color: lemonchiffon;border: 1px solid; border-color: #000000;  width:40%;height: 80%;">
                    <tr style="border: 1px solid; height:70px;">
                        <th style="width: 30%;">Payment ID:</th>
                        <th style="border: 1px solid; width: 40%;"><?php echo $row[0] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Transaction Type:</th>
                        <th style="border: 1px solid;text-transform:capitalize"><?php echo $row[1] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Shop ID:</th>
                        <th style="border: 1px solid;"><?php echo $row[2] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Shop Name:</th>
                        <th style="border: 1px solid;text-transform:capitalize"><?php echo $row[3] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Service Taken:</th>
                        <th style="border: 1px solid;text-transform:capitalize"><?php echo $row[4] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Customer ID:</th>
                        <th style="border: 1px solid;"><?php echo $row[5] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Customer Name:</th>
                        <th style="border: 1px solid;text-transform:capitalize"><?php echo $row[6] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Customer Phone:</th>
                        <th style="border: 1px solid;"><?php echo $row[7] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Delivary Type:</th>
                        <th style="border: 1px solid; text-transform:capitalize"><?php echo $row[8] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Date/Time:</th>
                        <th style="border: 1px solid;"><?php echo $row[9] ?></th>
                    </tr>
                    <tr style="border: 1px solid; height:70px;">
                        <th>Total Cost:</th>
                        <th style="border: 1px solid;"><?php echo $row[10] . 'BDT' ?></th>
                    </tr>

                    <tr style="height:70px;">

                        <th><a href="support.php?customer_id=<?php echo $row[5]; ?>&amp;shop_id=<?php echo $row[2]; ?>" class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" role="button">Give Feedback</a>&nbsp;</th>
                        <th><a class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" href="cartnew.php" role="button">See Selected Services</a> </th>
                    </tr>

                </table></br>
        <?php
            }
        }
        ?>



        <!-- FOOTER -->
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
                                        <p class="mt-1 fs-5 fw-normal"><small>copyright©carrepairinghub2023</small></p>
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