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
            <p class="text-center text-success" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-weight: bold;">
                Selected Services</br>
            <h5 style="text-align:center;font-size:small">(You Can Avail Only One Service At A Time)</h5>
            </p>
        </div>

        <!-- PHP CODE & SQL COMMANDS FOR DELETING THE SELECTED ITEM-->
        <?php
        if (isset($_GET['shop_id']) && isset($_GET['service_name'])) {
            $shop_id = $_GET['shop_id'];
            $service_name = $_GET['service_name'];
            $sql = "DELETE FROM selects WHERE shop_id = '$shop_id' AND service_name = '$service_name'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn)) {

                header("Location: cartnew.php");
            } else {
                echo " Failed";
                header("Location: cartnew.php");
            }
        }
        ?>

        <div style="margin-left:50px; margin-right:50px; margin-top:50px; margin-bottom:50px;text-align:center;background:lightblue;font-size:larger">
            <div class="row" style="padding:5px;">
                <div class="col-md-3" style="color:indigo;font-weight:bold"> Shop Name </div>
                <div class="col-md-3" style="color:indigo;font-weight:bold"> Service Name </div>
                <div class="col-md-3" style="color:indigo;font-weight:bold"> Cost(BDT) </div>
                <div class="col-md-3" style="color:indigo;font-weight:bold"></div>
            </div>

            <!-- PHP CODE & SQL COMMANDS FOR SHOWING THE SELECTED ITEM-->
            <?php
            $customer_id = $Data['id'];
            $sql = "SELECT  offered_services.shop_id,shops.shop_name,selects.service_name,offered_services.service_cost from((offered_services INNER JOIN selects on selects.service_name=offered_services.service_name 
            AND selects.shop_id=offered_services.shop_id) INNER JOIN shops on selects.shop_id=shops.shop_id) WHERE selects.customer_id='$customer_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

            ?>
                    <div class="row" style="padding:5px;;text-align:center">
                        <div class="col-md-3"><?php echo $row[1]; ?></div>
                        <div class="col-md-3"><?php echo $row[2]; ?></div>
                        <div class="col-md-3"><?php echo $row[3]; ?></div>
                        <div class="col-md-3">
                            <a href="payment_details.php?id=<?php echo $row[0]; ?>&amp;service_name=<?php echo $row[2]; ?>&amp;cost=<?php echo $row[3]; ?>">
                                <button style="background-color:#4CAF50;border: none; border-radius: 5px;color: white;">Avail</button>
                            </a>&nbsp;

                            <a href="cartnew.php?shop_id=<?php echo $row[0]; ?>&amp;service_name=<?php echo $row[2]; ?>">
                                <button style="border: none; border-radius: 5px;color: white;background-color:lightcoral">Delete</button>
                            </a>
                        </div></br>
                    </div>

            <?php
                }
            }
            ?>
            </br>
            <p style="text-align:center"><a class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" href="service.php" role="button">Add More Services!</a></p>


            <!----- Footer ----->
            <section id="footer">
                <script src="js/jquery.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <script src="js/jquery.isotope.min.js"></script>
                <script src="js/wow.min.js"></script>
            </section>
    </body>
    </html>