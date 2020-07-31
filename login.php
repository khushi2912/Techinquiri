<?php ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Techinquiri</title>

  <link href="assets/img/download.png" rel="icon">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body style="background: url(assets/img/tech.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-11 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="index.html">Techinquiri</a></h1>
          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li><a href="personal.html">Back to UserPortal</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header -->

    <section id="contact" style="margin-top: 8%;margin-left: 20%; margin-right: 20%;">
      <div class="container" data-aos="fade-up">
        <div class="form">
          <form action='' method="post" role="form" autocomplete="off">
            <br><br>
            <div class="form-group">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>

            <div class="text-center"><button class="btn btn-info" name="login" type="submit"><b>Login</b></button></div>
            <br>
            <p style="text-align: center;background-color:white;opacity:0.75"><b><i><a href="register.php">New User?&nbsp;Register here</a></i></b></p>
            <p style="text-align: center;background-color:white;opacity:0.75"><b><i>Forgot Password? Contact the admin.</i></b></p>
          </form>

        </div>
        <?php
            include("dbconnect.php");
            if(isset($_POST['login']))
            {
                $id=$_POST['username'];
                $pwd=$_POST['password'];
                $idcheck=array();
                $pwdcheck=array();
                $query1="SELECT user_id, password from info";
                $data=$conn->query($query1) or die("Error, Try again later.");
                while($row = $data->fetch_assoc())
                {
                    $temp = $row["user_id"];
                    array_push($idcheck,"$temp");
                    $temp = $row["password"];
                    array_push($pwdcheck,"$temp");
                }
                $flag=0;
                for($j=0;$j<sizeof($idcheck);$j++)
                {
                    if($id==$idcheck[$j])
                    {
                        $flag=1;
                    break;
                    }
                }
                if($flag==0)
                {
                    echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>Incorrect Username, Register yourself first.</p>";
                }
                elseif($flag==1 && $pwd!=$pwdcheck[$j])
                {
                    echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>Incorrect Password, Try Again.</p>";
                }
                elseif($flag==1 && $pwd==$pwdcheck[$j])
                {
                    $_SESSION['username']=$_POST['username'];
                    header('Location:userportal.php');
                }
            }
          ?>
      </div>
    </section>




  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
