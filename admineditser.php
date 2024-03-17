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
        <!-- PHP CODE $ SQL COMMANS TO SHOW THE SERVICES -->
        <?php
        $sql = "SELECT * FROM services";
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
                                    <h6 class="mb-0"><a href="admineditser.php?service_name=<?php echo $row[0]; ?>" class="btn btn-outline-success btn-rounded fs-8 my-auto " data-mdb-ripple-color="dark" role="button" style="background-color: crimson;color:#e8fafb" >Delete</a></h6>
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
        <p > <h5 style="color:darkviolet;text-align:center">ADD MORE SERVICE</h5> </p>
        <div class="col-md-8" style="text-align:center;width:100%">
            <div class="card mb-3" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9 text-secondary">
                            <h6 class="mb-0">
                                <form autocomplete="off" action="admineditser.php" style="align-items: center;" method="POST"><input type="text" style="align-items: center;" name="service_name" placeholder="Write New Service Name Here">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-outline-success btn-rounded fs-8 my-auto " data-mdb-ripple-color="dark">Add Service</button></form>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PHP CODE FOR ADDING SERVICE -->
        <?php
        if (isset($_POST['service_name'])) {
            $service_name = $_POST['service_name'];
            $sql = "INSERT INTO `services`(`service_name`) VALUES ('$service_name')";

            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn)) {

                echo "<script>window.location.href='admineditser.php'</script>";
            }
        }
        ?>


        <!-- PHP CODE FOR DELETING SERVICE -->
        <?php
        if (isset($_GET['service_name'])) {
            $service_name = $_GET['service_name'];
            $sql = "DELETE FROM `services` WHERE service_name='$service_name'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn)) {

                echo "<script>window.location.href='admineditser.php'</script>";
            }
        }
        ?>
    </body>