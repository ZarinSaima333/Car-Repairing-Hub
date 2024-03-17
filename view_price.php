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
                // echo 'Session is active';
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

    if (isset($_GET['shop_id'])) {
        $shop_id = $_GET['shop_id'];
        

        // Define the SQL query
        $sql = "SELECT o.shop_id, shop_name, service_name, service_cost, road, area, city, phone, Hours 
                FROM Offered_services o 
                INNER JOIN shops s ON o.shop_id=s.shop_id 
                WHERE o.shop_id=$shop_id;";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check for errors
        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }

        // Check if there are rows in the result
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            echo '<div class="text-center">';
            echo '<h4 class="mt-4 ">' . $row['shop_name'] . '</h4>';
            echo '<p>Address: ' . $row['road'] . ', ' . $row['area'] . ', ' . $row['city'] . '</p>';
            echo '<p>Hours: ' . $row['Hours'] . '</p>';
            echo '<p>Phone:' . $row['phone'] . '</p>';
            echo '</div>';

            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="row border">';
                echo '<div class="col-md-2 col-sm-2 mt-2">';

                echo '</div>';
                echo '<div class="col-md-7 col-sm-7 mt-1 fw-bold">';
                echo '<p>' . $row['service_name'] . '</p>';
                echo '<h5 class="fw-normal">BDT ' . $row['service_cost'] . '</h5>';
                echo '</div>';
                
                if ((session_status() === PHP_SESSION_ACTIVE) && ($Data['type']=='customer')){
                echo '<div class="col-md-3 col-sm-3 mt-4">';
                echo '<form action="view_price.php" method="GET">
        <input type="hidden" name="customer_id" value="' . htmlspecialchars($Data['id']) . '">
        <input type="hidden" name="shop_id" value="' . htmlspecialchars($shop_id) . '">
        <input type="hidden" name="service_name" value="' . htmlspecialchars($row['service_name']) . '">
        <button type="submit" style="background-color:#4CAF50;border: none; border-radius: 5px;color: white;">Add Service</button>
      </form>';
                echo '</div>';
                }
                echo '</div>';
            }
        } else {
            echo "No price chart";
        }
    } else {
        echo "No shop_id parameter";
    }
    ?>
    </br>

    <!-- PHP CODE & SQL COMMANDS FOR ADDING THE SELECTED ITEM-->
    <?php
    if (isset($_GET['customer_id']) && isset($_GET['shop_id']) && isset($_GET['service_name'])) {
        $customer_id = $_GET['customer_id'];
        $shop_id = $_GET['shop_id'];
        $service_name = $_GET['service_name'];
        $sql = "INSERT INTO `selects`(`customer_id`, `shop_id`, `service_name`) VALUES ('$customer_id','$shop_id','$service_name')";

        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn)) {
          echo '<div class="container mt-5 mb-5">';
          echo '<p class="alert alert-success">Added successfully!</p>';
          echo '</div>';

        } else {
            echo '<p style="text-align:center;transition-duration: 3s">This service is already added!</p>';
        }
    }
    
    ?>
<p class='mt-4' style="text-align:center"><a class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" href="review.php?shop_id=<?=$_GET['shop_id'] ;?>" role="button">Show Reviews</a></p>
    <?php
    if ((session_status() === PHP_SESSION_ACTIVE) && ($Data['type']=='customer')){
        ?>
        <p style="text-align:center"><a class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" href="cartnew.php" role="button">Show Selected Services</a></p>
    <?php
    }
    ?>
    </div>

</body>
</br>

<footer class='mt-4' style="background-color:#000000 ;">
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