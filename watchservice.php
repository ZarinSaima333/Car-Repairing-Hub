
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
                                    <li><a class="dropdown-item" href="shopOwner.php">Profile</a></li>
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
                Available Services</br>

            </p>
        </div></br>

        <div class="col-md-8" style="width:50%">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-9 text-secondary">
                                    <h4 class="mb-0" style="color:darkblue">Service Name</h4>
                                </div>
                                <div class="col-sm-3">
                                <h4 class="mb-0" style="color:darkblue">Charge</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- PHP CODE $ SQL COMMANS TO SHOW THE SERVICES -->
        <?php
        $shop_owner_id = $Data['id'];
        $sql = "SELECT offered_services.service_name,offered_services.service_cost FROM offered_services INNER JOIN shops ON offered_services.shop_id=shops.shop_id WHERE shops.owner_id=$shop_owner_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_array($result)) {

        ?>
                <div class="col-md-8" style="width:50%">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-9 text-secondary">
                                    <h4 class="mb-0" style="color:black"><?php echo $row[0]; ?></h4>
                                </div>
                                <div class="col-sm-3">
                                <h4 class="mb-0" style="color:black"><?php echo $cost=number_format($row[1],0); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        </div></div></div></div>

    </body>