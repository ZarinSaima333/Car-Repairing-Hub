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

        <!-- PHP CODE & SQL COMMANDS TO INSERT THE DATA FETCHED FROM THE FORM AND LINK-->
        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $service_name = $_GET['service_name'];
            $cost = $_GET['cost'];
        }

        if (
            isset($_POST['trans_type']) && isset($_POST['shop_id']) && isset($_POST['customer_id']) && isset($_POST['service_name'])
            && isset($_POST['delivary_type']) && isset($_POST['total_cost'])
        ) {
            $trans_type = $_POST['trans_type'];
            $shop_id = $_POST['shop_id'];
            $customer_id = $_POST['customer_id'];
            $service_name = $_POST['service_name'];
            $delivary_type = $_POST['delivary_type'];
            $total_cost = $_POST['total_cost'];

            $sql = "INSERT INTO `payment_details`(`trans_type`, `shop_id`, `service_name`, `customer_id`, `delivary_type`, `total_paid`)VALUES('$trans_type', '$shop_id', '$service_name', '$customer_id', '$delivary_type',  '$total_cost')";


            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn)) {
                $lastsertedID = mysqli_insert_id($conn);
                $payment_id = urlencode($lastsertedID);

                header("Location:payment.php?payment_id=$payment_id&shop_id=$shop_id&service_name=$service_name");
            } else {

                header("Location: payment_details.php");
            }
        }
        ?>


        <div class="container fs-4 py-4" style="background-color: #e8fafb ; ">
            <p class="text-center text-success" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-weight: bold;">Fillout Necessary Details</p>
        </div></br>

        <div class="container" style="background-color: lightblue; width: 100%;">
            <div class="row">
                <div class="col-md-8">
                    <div class="main-col">
                        <div class="block">
                            <h1 class="pull-left">Payment Details</h1>
                            
                            <div class="clearfix"></div>
                            <hr>
                            <form role="form" enctype="multipart/form-data" method="post" action="payment_details.php">
                                <div class="form-group"><label style="font-size: larger;">Transaction Type:*</label>
                                    <select name="trans_type">
                                        <option value="cash">Cash</option>
                                        <option value="bkash">Bkash</option>
                                        <option value="nagad">Nagad</option>
                                        <option value="online banking">Online Banking</option>
                                    </select>
                                </div></br>
                                <div class="form-group">
                                    <label style="font-size: larger;">Shop ID:</label>
                                    <input type="int" class="form-control" name="shop_id" value="<?php echo $id ?>">
                                </div></br>
                                <div class="form-group">
                                    <label style="font-size: larger;">Customer ID:</label>
                                    <input type="text" class="form-control" name="customer_id" value="<?php echo $Data['id'] ?>">
                                </div></br>
                                <div class="form-group">
                                    <label style="font-size: larger;">Service Name:</label>
                                    <input type="text" class="form-control" name="service_name" value="<?php echo $service_name ?>">
                                </div></br>
                                <div class="form-group">
                                    <label style="font-size: larger;">Delivary Type:*</label>
                                    <select name="delivary_type">
                                        <option value="take-in">Take-In</option>
                                        <option value="take-away(FROM CURRENT LOCATION)">Take-Away(FROM CURRENT LOCATION)</option>
                                        <option value="take-away(FROM HOME ADDRESS)">Take-Away(FROM HOME ADDRESS)</option>
                                    </select>
                                </div></br>
                                <div class="form-group">
                                    <label style="font-size: larger;">Total Cost(BDT):</label> <input type="text" class="form-control" name="total_cost" value="<?php echo $cost ?>">
                                </div></br>
                                <div class="d-flex justify-content-center gap-3 mb-2 pb-3">
                                    <input type="submit" class="btn btn-outline-success btn-rounded fs-5 my-auto " value="Confirm" />
                                    <input name="reset" type="reset" class="btn btn-outline-success btn-rounded fs-5 my-auto " value="Reset" />
                            </form></br>
                        </div></br>
                    </div></br>
                </div>
                </br></br></br>


                <!----- Footer ----->
                <section id="footer">
                    <script src="js/jquery.js"></script>
                    <script src="js/bootstrap.min.js"></script>
                    <script src="js/jquery.isotope.min.js"></script>
                    <script src="js/wow.min.js"></script>
                </section>
    </body>

    </html>