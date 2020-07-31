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
        <div class="container" data-aos="fade-up" style="overflow:visible">
          <div class="form"">
            <form action='' method="post" role="form" autocomplete="off">
                <br><br>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required>
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Mobile No." required>
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <select name="city" class="form-control" id="city" required>
                    <option value="pick" disabled>Select City</option>
                        <?php
                        include("dbconnect.php");
                        $sql = "SELECT city From chapter";
                        $data = $conn->query($sql) or die("Couldn't fetch");
                            while ($row = $data->fetch_assoc())
                            {
                                echo "<option value='". $row['city'] ."'>" .$row['city'] ."</option>" ;
                            }
                        ?>
                </select>
                </div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                <div class="validate"></div>
              </div>
              <div class="text-center"><button class="btn btn-info" name="register" type="submit"><b>Register</b></button></div>
              <br><br>
            </form>
            <p class="text-center" style="background-color:white;opacity:0.6;color:black">Couldn't find your city? <a href="index.html#contact">Send us a message</a> to expand our reach in your city</p>
          </div>
          <?php
            include("dbconnect.php");
            if(isset($_POST['register']))
            {
                $id=$_POST['fname'].$_POST['lname'];
                $name=$_POST['fname'];
                $mobile=$_POST['mobile'];
                $city=$_POST['city'];
                $email=$_POST['email'];
                $query1="INSERT INTO member values ('$id','$name','$mobile','$city','$email')";
                $conn->query($query1) or die("Error, Member.");
                $query2="INSERT INTO info(user_id,password) values ('$id',DEFAULT)";
                $query3="INSERT INTO m1(user_id) values ('$id')";
                $query4="INSERT INTO m2(user_id) values ('$id')";
                $query5="INSERT INTO m3(user_id) values ('$id')";
                $query6="INSERT INTO m4(user_id) values ('$id')";
                $conn->query($query2) or die("Error, info");
                $conn->query($query3) or die("Couldn't insert in M1");
                $conn->query($query4) or die("Couldn't insert in M2");
                $conn->query($query5) or die("Couldn't insert in M3");
                $conn->query($query6) or die("Couldn't insert in M4");
                echo "<p style='background-color:white;opacity:1;text-align:center;color:#18d26e'><b>You have been registered successfully. Your userid is $id and system generated password is <i>Techinquiri@000</i></b></p>";
                echo "<p style='background-color:white;opacity:0.75;text-align:center'><a href='login.php'>Back to login</p>";
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
