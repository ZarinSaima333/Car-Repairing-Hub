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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><?php echo "admin" . $Data['id'] ?></a>
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



    <div>
      <p style="color:#3A6E89" class="text-center fs-3 fw-light mt-5">Want to drop your Suggestion/Review/complain</p>
      <h1 class="text-center fs-6 fw-normal mt-3 mb-4">If you’ve got a question, a comment or just want to talk more about the site with us, give a message and we’ll be sure to get in touch.</h1>
    </div>
    <div class="divider"></div>

    <p style="font-family: Montserrat ; text-align: center; font-size: 40px;font-weight: 100;">Contributers</p>

    <div style="float: left; width: 30%">

      <p style="text-align: center;"><img src="https://cdn.iconscout.com/icon/free/png-512/avatar-370-456322.png" alt="Avatar" style="width:250px"></p>
      <h2 style="text-align: center; font-family:Montserrat ">Md. Mehedi Hasan Sohag</h2>
      <h2 style="text-align: center; font-family:Montserrat;font-size:small;color: darkblue;"><a class="nav-link active" href="mehedi.hasan.shohag@g.bracu.ac.bd">mehedi.hasan.shohag@g.bracu.ac.bd</a></h2>

    </div>

    <div style="float: left; width: 20%">

      <p style="text-align: center;"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5GNdfefPfPYzh0VvZB3WUDPk8x07-oC-a0A&usqp=CAU" alt="Avatar" style="width:250px"></p>
      <h2 style="text-align: center; font-family:Montserrat ">Sumaiya Azad Isha</h2>
      <h2 style="text-align: center; font-family:Montserrat;font-size:small;color: darkblue;"><a class="nav-link active" href="sumaiya.azad.isha@g.bracu.ac.bd">sumaiya.azad.isha@g.bracu.ac.bd</a></h2>


    </div>

    <div style="float: left; width: 20%">

      <p style="text-align: center;"><img src="https://cdn1.iconfinder.com/data/icons/avatars-1-5/136/60-512.png" alt="Avatar" style="width:250px"></p>
      <h2 style="text-align: center; font-family:Montserrat ">Zarin Saima Roza</h2>
      <h2 style="text-align: center; font-family:Montserrat;font-size:small;color: darkblue;"><a class="nav-link active" href="zarin.saima.roza@g.bracu.ac.bd">zarin.saima.roza@g.bracu.ac.bd</a></h2>

    </div>

    <div style="float: left; width: 30%">

      <p style="text-align: center;"><img src="https://cdn4.iconfinder.com/data/icons/avatars-21/512/avatar-circle-human-female-5-512.png" alt="Avatar" style="width:250px"></p>
      <h2 style="text-align: center; font-family:Montserrat ">Fariha Mohammad Al Zahir</h2>
      <h2 style="text-align: center; font-family:Montserrat;font-size:small;color: darkblue;"><a class="nav-link active" href="fariha.mohammad.alzahir@g.bracu.ac.bd">fariha.mohammad.alzahir@g.bracu.ac.bd</a></h2>

    </div>

    </div></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>



  </body>
  <footer style="background-color:#000000 ;">
    <div>
      <div class="footer-container text-light">
        <div class="container">
          <div class="row">
            <div class="col-md-5">
              <div class="left-container text-start mt-3">
                <h3>Car Reparing Hub</h3>
                <p class="mt-1 fs-5 fw-normal"><small>copyrightÂ©carrepairinghub2023</small></p>
              </div>
            </div>
            <div class="col-md-2"></div>

          </div>
        </div>
      </div>
    </div>
  </footer>

  </html>