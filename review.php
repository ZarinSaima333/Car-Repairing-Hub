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
$shop_id="";
    if (isset($_GET['shop_id'])) {
       $shop_id = $_GET['shop_id'];
        

        
        $sql ="SELECT s.shop_id, shop_name,road, area, city, phone, hours, AVG(r.rating) AS rating FROM shops s LEFT JOIN rate r ON r.shop_id = s.shop_id where s.shop_id=$shop_id 
        GROUP BY s.shop_id;";
        $sql1="SELECT user_id,shop_id,review,name FROM  reviews  INNER JOIN user  ON customer_id=user_id WHERE shop_id=$shop_id";
      
        $result = mysqli_query($conn, $sql);
        $result1 = mysqli_query($conn, $sql1);

      
        if (!$result or !$result1) {
            die("Error: " . mysqli_error($conn));
        }

        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            echo '<div class="text-center">';
            echo '<h4 class="mt-4 ">' . $row['shop_name'] . '</h4>';
            echo '<p>Address: ' . $row['road'] . ', ' . $row['area'] . ', ' . $row['city'] . '</p>';
            echo '<p>Hours: ' . $row['hours'] . '</p>';
            echo '<p>Phone:' . $row['phone'] . '</p>';
            echo '<h6>Rating: '  .$ratings = number_format($row['rating'], 1). '</h6>';
            echo "<hr>";         
            echo '</div>';
        }
        if (mysqli_num_rows($result1) > 0) {   
            echo '<div class="text-center">';
            echo '<h4 class="mt-3 ">Customer Review</h4>';  
            echo '</div>';  
            while ($row1 = mysqli_fetch_array($result1)) {
                echo '<div class="row border">';
                echo '<div class="col-md-1 col-sm-7 mt-2">';

                echo '</div>';
                echo '<div class="col-md-7 col-sm-7 mt-1 fw-bold">';
                echo '<p>' . $row1['name'] . '</p>';
                echo '<h5 class="fw-normal"> '. $row1['review'] .  '</h5>';
                echo '</div>';
            }
            echo"<hr>";
        }else{
            echo '<div class="text-center">'; 
            echo '<h4 class="mt-3 ">No reviews yet!</h4>';
            echo "<hr>";
            echo '</div>';
        }


    }
    ?>

<?php
$id = $_SESSION['user_data']['id'];
$sql4="SELECT * From payment_details WHERE customer_id=$id and shop_id=$shop_id ";
$result4 = mysqli_query($conn, $sql4);

    if ((session_status() === PHP_SESSION_ACTIVE) && ($Data['type']=='customer') && mysqli_num_rows($result4) > 0){
        ?>
<p class='mt-4' style="text-align:center"><a class="btn btn-outline-success btn-rounded fs-5 my-auto " data-mdb-ripple-color="dark" href="review_process.php?shop_id=<?=$shop_id ;?>" role="button">Write a Review</a></p>

<?php }?>

        <footer style="background-color:#000000 ;">
            <div><div><div class="footer-container text-light"><div class="container"><div class="row"><div class="col-md-5"><div class="left-container text-start mt-3"><h3>Car Reparing Hub</h3><div class="icons-container d-flex text-center "><div class="icon d-flex gap-4 mb-1"><i class="fab fa-facebook" aria-hidden="true"></i><i class="fab fa-instagram" aria-hidden="true"></i><i class="fab fa-twitter" aria-hidden="true"></i><i class="fab fa-youtube" aria-hidden="true"></i></div></div><p class="mt-1 fs-5 fw-normal"><small>copyrightÂ©carrepairinghub2022</small></p></div></div><div class="col-md-2"></div><div class="col-md-5">
                <div class="right-footer-container mt-4 fs-6 align-items-center gap-2 d-flex justify-content-center text-light "><h5 class="pt-3">Your email:</h5><input class="footer-input mt-2" type="text" size="30" placeholder="Enter Email"><div class="phone d-flex align-items-center justify-content-center mt-4"><div class="foter-phone-icon"></div></div></div></div></div></div></div></div></div>
        </footer>
      </body>  