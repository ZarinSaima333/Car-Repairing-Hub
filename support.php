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
                    <a class="navbar-brand d-flex align-items-center fs-5 fw-bold" href="#"><img
                            src="https://media.discordapp.net/attachments/939266966265417768/1053518288396767262/logo.png"
                            alt="" width="50" height="50" class="d-inline-block align-text-top rounded-circle"><span
                            class="ms-2 font-weight-bold">Car Reparing Hub</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse fs-6 fw-semibold " id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0  d-flex align-items-center" >
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="services.html">Services</a>
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

 <!-- PHP CODE & SQL COMMANDS TO INSERT DATA INTO REVIEW & RATING TABLE-->
        <?php
        if (isset($_GET['customer_id']) && isset($_GET['shop_id'])) {
            $customer_id = $_GET['customer_id'];
            $shop_id = $_GET['shop_id'];
        }

        if (isset($_POST['customer_id'])  && isset($_POST['shop_id']) && isset($_POST['review'])&& isset($_POST['rating'])) {
            $customer_id = $_POST['customer_id'];
            $shop_id = $_POST['shop_id'];
            $review = $_POST['review'];
            $rating = $_POST['rating'];
            

            $sql = "INSERT INTO `rate` (`customer_id`, `shop_id`, `rating`) VALUES ('$customer_id', '$shop_id', '$rating') ON DUPLICATE KEY UPDATE rating='$rating'";

            $sql1 = "INSERT INTO `reviews` (`customer_id`, `shop_id`, `review`) VALUES ('$customer_id', '$shop_id', '$review')";

            $result = mysqli_query($conn, $sql);
            $result1 = mysqli_query($conn, $sql1);

            if (mysqli_affected_rows($conn)) {



                header("Location: msg.php");
            } else {
                echo "There is an error";
                header("Location: support.php");
            }
        }
        ?>


        <div class="text-center fw-semibold fs-5 mb-5">
            <p class="mb-5">
                Get us <span style="color:#398D7F ;"> 24/7 </span> anytime, any day !! Contact us on <span style="color: #398D7F;"> 02 9362219/ 02 9350936</span>
            </p>
        </div>
        <div>
            <p style="color:#3A6E89" class="text-center fs-3 fw-light mt-5">Want to drop your Suggestion/Review/complain</p>
            <h1 class="text-center fs-6 fw-normal mt-3 mb-4">If you’ve got a question, a comment or just want to talk more about your fitness goals leave us a message and we’ll be sure to get in touch.</h1>
        </div>
        <div class="container">
            <form role="form" enctype="multipart/form-data" method="post" action="support.php">
                <div class="mb-3"><label class="form-label" for="exampleForm.ControlInput1" style="font-size: larger;">Customer ID</label><input type="id" name="customer_id" class="form-control" value="<?php echo $customer_id ?>">
                </div>
                <div class="mb-3"><label class="form-label" for="exampleForm.ControlInput1" style="font-size: larger;">Shop ID</label><input type="id" name="shop_id" class="form-control" value="<?php echo $shop_id ?>">
                </div>
                <div class="mb-3"><label class="form-label" for="exampleForm.ControlTextarea1" style="font-size: larger;">Review</label><textarea name="review" cols="45" rows="1"></textarea>
                </div>
                <div class="mb-3"><label class="form-label" for="exampleForm.ControlInput1" style="font-size: larger;">Rate Us:</label>
                    <select name="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="0">0</option>
                    </select>
                </div>
                <div class="container mt-5 mb-5">
                    <input type="submit" class="btn btn-outline-success btn-rounded fs-5 my-auto " value="Submit" />
                </div>
            </form>

        <footer style="background-color:#000000 ;width:100%">
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
                                        <p class="mt-1 fs-5 fw-normal"><small>copyright©carrepairinghub2023</small></p>
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