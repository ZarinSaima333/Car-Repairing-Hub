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
    <!-- <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/d086d29649.js" crossorigin="anonymous"></script> -->
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

   
        <div class="mt-5 text-center">
            <form method="post"> 
                <input class="mb-5" type="text" id="query" name="search" size="30" style=" border-radius: 5px ;"  placeholder="Search nearby vehicle repair shops">
                <button class="rounded-pill btn btn-success btn-sm" name="submit">Search</button>
              </form>
         </div>
         <div>
            <h4 class="text-center fw-light">
                Get all your car services and products from one place.
            </h4>
            <h4 class="text-center fw-light">
                Nearby Automobile Repair shops
            </h4>
            <hr>
         </div>
<?php 
if (isset($_POST['submit'])){
    
    $area=$_POST['search'];
    $sql = "SELECT s.shop_id, shop_name,road, area, city, phone, hours, AVG(r.rating) AS rating FROM shops s LEFT JOIN rate r ON r.shop_id = s.shop_id where 
    area='$area' GROUP BY s.shop_id;";
    $result = mysqli_query($conn, $sql);
    
    ?>


            <?php
            if(mysqli_num_rows($result) > 0){
                echo '<h4 class="text-center ">Shops Nearby ' . $area . ':</h4>'; ?>
                <p></p>
                <div class="container">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                
                //Here I'm Looping through each row to generate cards
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col">
                        <div class="card h-100">
                            
                            <div class="card-body">
                           
                                <h5 class="card-title text-center"><?php echo $row['shop_name']; ?></h5>
                                <p class="card-text pt-1">Address: <?php echo $row['road'],", ",$row['area'],", ",$row['city']; ?></p>
                                <p>Hours: <?php echo $row['hours']; ?></p>
                                <p>Phone: <?php echo $row['phone']; ?></p>
                                <p>Rating: <?php echo $ratings = number_format($row['rating'], 1); ?></p>
                                <a class="btn btn-success btn-rounded my-auto btn-sm" data-mdb-ripple-color="dark"
                                    href="view_price.php?shop_id=<?=$row["shop_id"];?>" type="button">
                                    View price chart
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<h4 class="text-center">No shops in this area.</h4>';
}


            ?>
        </div>
    </div>

 <?php   } ?>
<hr>

<?php
$sql2 = "SELECT * FROM services";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {
?>

    <div class="mt-5 text-center">
        <form role="form" enctype="multipart/form-data" method="GET" action="shortlist_service.php">
            <div class="form-group">
                <label style="font-size: larger;"> Search Service:</label>
                <select name="service_name">
                    <?php
                    while ($row = mysqli_fetch_assoc($result2)) {
                        echo "<option value='" . $row['service_name'] . "'>" . $row['service_name'] . "</option>";
                    }
                    ?>
                </select>
            
            <button class="rounded-pill btn btn-success btn-sm" type="submit">Search</button>
            </div>
        </form>
    </div>

<?php } else {
    echo "No Services";
} ?>
<div>
    <h4 class="mt-4 text-center fw-light">
        Get your needed services in one search.
    </h4>
    <hr>
</div>

<hr>

<h4 class="card-title text-center">Available Shops:</h4>
<p></p>
<?php 
require_once("dbconnect.php");
$sql = "SELECT s.shop_id, shop_name,road, area, city, phone, hours, AVG(r.rating) AS rating FROM shops s LEFT JOIN rate r ON r.shop_id = s.shop_id GROUP BY s.shop_id; ";
$result = mysqli_query($conn, $sql);
?>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            if(mysqli_num_rows($result) > 0){
                //Here I'm Looping through each row to generate cards
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col">
                        <div class="card h-100">
                            
                            <div class="card-body">
                                
                                <h5 class="card-title text-center"><?php echo $row['shop_name']; ?></h5>
                                <p class="card-text pt-1">Address: <?php echo $row['road'],", ",$row['area'],", ",$row['city']; ?></p>
                                <p>Hours: <?php echo $row['hours']; ?></p>
                                <p>Phone: <?php echo $row['phone']; ?></p>
                                <p>Rating: <?php  echo $ratings = number_format($row['rating'], 1); ?></p>
                                <a class="btn btn-success btn-rounded my-auto btn-sm" data-mdb-ripple-color="dark"
                                    href="view_price.php?shop_id=<?=$row["shop_id"];?>" type="button">
                                    View price chart
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No shops found in the database.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>

    
</body>

</html>


<footer style="background-color:#000000 ;">
        <div><div><div class="footer-container text-light"><div class="container"><div class="row"><div class="col-md-5"><div class="left-container text-start mt-3"><h3>Car Reparing Hub</h3><div class="icons-container d-flex text-center "><div class="icon d-flex gap-4 mb-1"><i class="fab fa-facebook" aria-hidden="true"></i><i class="fab fa-instagram" aria-hidden="true"></i><i class="fab fa-twitter" aria-hidden="true"></i><i class="fab fa-youtube" aria-hidden="true"></i></div></div><p class="mt-1 fs-5 fw-normal"><small>copyright©carrepairinghub2022</small></p></div></div><div class="col-md-2"></div><div class="col-md-5">
            <div class="right-footer-container mt-4 fs-6 align-items-center gap-2 d-flex justify-content-center text-light "><h5 class="pt-3">Your email:</h5><input class="footer-input mt-2" type="text" size="30" placeholder="Enter Email"><div class="phone d-flex align-items-center justify-content-center mt-4"><div class="foter-phone-icon"></div></div></div></div></div></div></div></div></div>
    </footer>
  </body>
  <footer class="mt-4" style="background-color:#000000 ; position:fixed;bottom: 0;width:100%;">