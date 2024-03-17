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
                      <li><a class="dropdown-item" href="adminprofile.php">Profile</a></li>
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

    <div class="container">
      <img style="width:100% ; height:60% ;" src="https://media.discordapp.net/attachments/939266966265417768/1053522810850512896/frontpagelogo.png" alt="">
    </div>
    <div class="container mt-5 mb-5 ">
      <div class="row row-cols-1 row-cols-md-3 g-4 ">
        <div class="col">
          <div class="border-end h-200 pt-2 ">
            <img src="https://www.zantrik.com/wp-content/uploads/2020/05/StandardGarage-300x300.png" class=" card-img-top  pb-2" style="width: 60%; padding-left: 150px;" alt="" />
            <div class="card-body">
              <p class="card-text text-center fs-5">
                Verified Garages With Standard Price Chart
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="border-end h-200 pt-2 ">
            <img src="https://images.vexels.com/media/users/3/147727/isolated/preview/8e4a2f66cf05c1f4b4f4a5c87c89086c-car-search-service-logo.png" class=" card-img-top pb-2" style="width: 60%; padding-left: 150px;" alt="" />
            <div class="card-body">
              <p class="card-text text-center fs-5">
                Search Nearby Vehicle Repair Shops
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="h-200 pt-2 ">
            <img src="https://www.zantrik.com/wp-content/uploads/2020/05/HomeRH-300x300.png" class=" card-img-top  pb-2" style="width: 60%; padding-left: 150px;" alt="" />
            <div class="card-body">
              <p class="card-text text-center fs-5">
                Roadside Assistance
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container d-flex col-8 gap-2">
      <div>
        <h2 class="mt-5">Skip crowded waiting rooms</h2><br>
        <h4 style="color: #3A6E89;">GET ALL THE SERVICES IN ONE PLACE</h4>
        <hr>
        <h5 class="text-muted">
          We offer all types of vehicle services.
          You can also compare price charts to get the best repair shop for you. Book with confidence.
        </h5>
      </div>
      <div>
        <img src="logos/ img1.png" style="width:300px" alt="">
      </div>
    </div>


    <div class="container d-flex col-8 gap-2">
      <div>
        <img src="https://www.zantrik.com/wp-content/uploads/2020/05/STANDARD-MAINTENANCE-1-768x512.png" class="mt-5" style="width:350px" alt="">
      </div>
      <div class="mt-5 ps-5">
        <h2>No more worry about Cost & Quality</h2><br>
        <h4 style="color: #00BF9F;">STANDARD PRICE CHART</h4>
        <hr>
        <h5 class="text-muted">
          Calculate cost using price chart, no hidden game. Enjoy the best service in the town by verified garages.
        </h5>
      </div>

    </div>
    <div class="container d-flex col-8 gap-2">
      <div>
        <h2 class="mt-5 ">Drive anywhere in Peace</h2><br>
        <h4 style="color: #3A6E89;">ROADSIDE ASSISTANCE</h4>
        <hr>
        <h5 class="text-muted">
          In case there is any trouble, tap <span style="color:#3A6E89 ;">Car repairing Hub</span> or give us a call. Help will reach in no time!
        </h5>
      </div>
      <div>
        <img src="https://media.discordapp.net/attachments/939266966265417768/1053525808771239956/img2.png" style="width:350px" alt="">
      </div>
    </div>

    <div>
      <img src="" alt="">
    </div>
    <div class="container fs-4 py-4" style="background-color: #e8fafb ;">
      <p class="text-center text-success ">Enjoy convenient car repair and maintenance at your home or office. It's as easy as 1-2-3!!
      </p>
    </div>
    <div class="container mt-5 text-center fw-light">
      <h4 class="fw-light">Enjoy all services in one place</h4>
      <h4 class="fw-lighter mb-5">
        From wash till engine change, you get everything.
      </h4>
    </div>


    <?php
    require_once("dbconnect.php");
    $sql = "SELECT * FROM services";
    $result = mysqli_query($conn, $sql);

    ?>



    <div class="container row row-cols-1 row-cols-md-2 gap-5 d-flex justify-content-center mt-3 mb-3 ms-3 padding-left-2">
      <?php
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
      ?>
        <a class="btn text-white shadow " style="background-color: #ffffff; width: 90px; height: 50px;" href="shortlist_service.php?service_name=<?= "Oil Fill" ?>" role="button">
          <img src="https://www.zantrik.com/wp-content/uploads/2020/04/oilchange-300x300.png" style="width: 50%" alt="">
        </a>
        <a class="btn text-white shadow" style="background-color: #ffffff; width: 90px; height: 50px;" href="shortlist_service.php?service_name=<?= "Full Car Wash" ?>" role="button">
          <img src="https://www.zantrik.com/wp-content/uploads/2020/04/car-wash-300x300.png" style="width: 50%" alt="">
        </a>

        <a class="btn text-white shadow" style="background-color: #ffffff; width: 90px; height: 50px;" href="shortlist_service.php?service_name=<?= "Dent and Paint Full Car"; ?>" role="button">
          <img src="https://www.zantrik.com/wp-content/uploads/2020/04/painting-300x300.png" style="width: 50%" alt="">
        </a>
        <a class="btn text-white shadow" style="background-color: #ffffff; width: 90px; height: 50px;" href="shortlist_service.php?service_name=<?= "AC Repair" ?>" role="button">
          <img src="https://www.zantrik.com/wp-content/uploads/2020/04/ac-300x300.png" style="width: 50%" alt="">
        </a>
        <a class="btn text-white shadow" style="background-color: #ffffff; width: 90px; height: 50px;" href="shortlist_service.php?service_name=<?= "Engine Change" ?>" role="button">
          <img src="https://www.zantrik.com/wp-content/uploads/2020/04/engine-300x300.png" style="width: 50%" alt="">
        </a>

    </div>
  <?php
      } else {
        echo "No shops has this service.";
      }
  ?>
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