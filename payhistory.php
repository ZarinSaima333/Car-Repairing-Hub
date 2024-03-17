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
            <p class="text-center text-success" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-weight: bold;">Payment History</p>
        </div></br>

        <table style="  margin-left: auto; margin-right: auto; background-color:floralwhite;border: 1px solid; border-color: #000000; width:90% ;height: 60%;">
            <tr style="border: 1px solid; height:50px;">
                <th style="border: 1px solid;color:darkviolet;border-color:#000000">Payment ID</th>
                <th style="border: 1px solid;color:darkviolet;border-color:#000000">Transaction Type</th>
                <th style="border: 1px solid;color:darkviolet;border-color:#000000">Shop ID</th>
                <th style="border: 1px solid;color:darkviolet;border-color:#000000">Shop Name</th>
                <th style="border: 1px solid;color:darkviolet;border-color:#000000">Service Taken</th>
                <th style="border: 1px solid;color:darkviolet;border-color:#000000">Delivary Type</th>
                <th style="border: 1px solid;color:darkviolet;border-color:#000000">Date/Time</th>
                <th style="border: 1px solid;color:darkviolet;border-color:#000000">Total Paid(BDT)</th>

            </tr>


<!-- PHP CODE & SQL COMMANDS TO SHOW THE PAYMENT HISTORY -->
            <?php
            $customer_id = $Data['id'];

            $sql = "SELECT payment_details.payment_id,payment_details.trans_type,payment_details.shop_id,shops.shop_name,payment_details.service_name,payment_details.customer_id,payment_details.delivary_type,payment_details.date,
            payment_details.total_paid from (payment_details INNER JOIN shops on shops.shop_id=payment_details.shop_id) WHERE payment_details.customer_id='$customer_id'";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {

            ?>
                <div>
                    <tr style="border: 1px solid; height:70px;">
                        <th style="border: 1px solid;"><?php echo $row[0] ?></th>
                        <th style="border: 1px solid;text-transform:capitalize"><?php echo $row[1] ?></th>
                        <th style="border: 1px solid;"><?php echo $row[2] ?></th>
                        <th style="border: 1px solid;"><?php echo $row[3] ?></th>
                        <th style="border: 1px solid;"><?php echo $row[4] ?></th>
                        <th style="border: 1px solid;text-transform:capitalize"><?php echo $row[6] ?></th>
                        <th style="border: 1px solid;"><?php echo $row[7] ?></th>
                        <th style="border: 1px solid;"><?php echo $total=number_format($row[8],0) ?></th>
                    </tr>
                </div>
            <?php
                }
                echo "</table></br></br>";
            }else {
                echo '<p style="text-align:center;color:mediumslateblue;font-weight:bold">No Records Till Now</p>';
                echo "</table></br></br>";
                
            }
            ?>            


            <table style="  margin-left: auto; margin-right: auto; background-color:lightgreen;border: 1px solid; border-color: #000000; width:30% ;height: 80%;">
                <tr style="border: 1px solid; height:50px;">
                    <th style="border: 1px solid;">Grand Total(BDT)</th>
                    <th style="border: 1px solid;">Num Of Service Taken</th>
                </tr>

<!-- PHP CODE & SQL COMMANDS TO SHOW TOTAL PAID &  NUM OF TAKEN SERVICES SO FAR -->
                <?php
                $customer_id = $Data['id'];

                $sql1 = "SELECT SUM(total_paid),COUNT(payment_id) FROM payment_details where customer_id=$customer_id;";

                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while ($row = mysqli_fetch_array($result1)) {

                ?>
                    <div>
                        <tr style="border: 1px solid; height:70px;">
                            <th style="border: 1px solid;"><?php echo $grand=number_format($row[0],0) ?></th>
                            <th style="border: 1px solid;"><?php echo $row[1] ?></th>
                        </tr>
                    </div>
                <?php
                    }
                    echo "</table></br>";
                }else{

                    echo "NO RECORD";
                }
                ?>
                <p style="text-align:center"><a class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" href="custprofile.php" role="button"> Go Back To Profile</a></p>

                
    </body>