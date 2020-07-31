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

  <link href="jquery/jquery-ui.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-11 d-flex align-items-center">
            <?php
                include("dbconnect.php");
                $p=$_SESSION['username'];
                $Fname="SELECT name from member where user_id='$p'";
                $F=$conn->query($Fname);
                while($row=$F->fetch_assoc())
                {
                    $N=$row['name'];
                }
                echo "<h1 class='logo mr-auto'><a href='index.html'>Hello $N</a></h1>";
            ?>
          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li class="active"><a href="#changepwd">Change Password</a></li>
              <li><a href="#available">Mark Availability</a></li>
              <li><a href="login.php">Logout</a></li>
            </ul>
          </nav>

        </div>
      </div>

    </div>
  </header>
  <!-- End Header -->
  <main id="main">

  <section id="changepwd" style="height:100vh;width:100vw;background: linear-gradient(rgba(0, 142, 99, 0.1), rgba(0, 0, 0, 0.1)), url(assets/img/call-to-action-bg.jpg) fixed center center;
  background-size: cover;
  padding: 60px 0">
    <div class="container" data-aos="fade-up">
        <div class="form" style="padding-top:20%">
            <form action="" method="post" role="form">
                <div class="form-group">
                    <input type="password" class="form-control" name="currentp" id="currentp" placeholder="Current Password" required/>
                    <div class="validate"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="newp" placeholder="New Password" required/>
                    <div class="validate"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="cnewp" placeholder="Confirm New Password" required/>
                    <div class="validate"></div>
                </div>
                <div class="text-center"><button name="change" type="submit">Change password</button></div>
            </form>
            <br>
        </div>
        <?php
            include("dbconnect.php");
            if(isset($_POST['change']))
            {
                $p=$_SESSION['username'];
                $pwd=$_POST['currentp'];
                $npwd=$_POST['newp'];
                $cnpwd=$_POST['cnewp'];
                $query="SELECT password from info where user_id='$p'";
                $F=$conn->query($query);
                while($row=$F->fetch_assoc())
                {
                    $N=$row['password'];
                }
                if($N!=$pwd)
                {
                    echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>Entered current password is incorrect.</p>";
                }
                elseif($npwd!=$cnpwd)
                {
                    echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>Your new password does not match.</p>";
                }
                else{
                    $query="UPDATE info set password='$npwd' where user_id='$p'";
                    $conn->query($query) or die("Couldn't update the password. Try later");
                    echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>Password Changed</p>";
                }
            }
        ?>
    </div>
  </section>

  <section id="available" style="height:100vh;width:100vw">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
            <div class="heading" style="padding-top:10%">
              <h3 class="cd-headline clip is-full-width">
                Mark Your Availabilities
              </h3>
            </div>
        </header>

        <form action='' method='post' role='form' style="text-align:center" autocomplete="off">
          Available Days <input type="text" name="date" id="datepicker">
          <script src="jquery/external/jquery/jquery.js"></script>
          <script src="jquery/jquery-ui.js"></script>
          <script>
            $( "#datepicker" ).datepicker({
            inline: true,
            changeMonth: true,
            changeYear: false,
            stepMonths: true,
            dateFormat: 'dd MM',
            minDate: -0,
            maxDate: '+120D',
            });
          </script>
          <button name="save" type="submit">Save</button>
          </form>
        </div>
        <br>
      <?php
        include("dbconnect.php");
        if(isset($_POST['save']))
        {
            $id=$_SESSION['username'];
            $data=$_POST['date'];
            $date=substr($data,0,2);
            $mon=substr($data,3);
            $mon1=date('F');
            $mon2=date('F', strtotime('+1 month'));
            $mon3=date('F', strtotime('+2 month'));
            $mon4=date('F', strtotime('+3 month'));
            $col='day'.$date;
            if($mon==$mon1)
            {
              $query1="UPDATE m1 set $col='Y' where user_id='$id'";
              $conn->query($query1) or die("couldnt add");
            }
            elseif($mon==$mon2)
            {
              $query2="UPDATE m2 set $col='Y' where user_id='$id'";
              $conn->query($query2) or die("couldnt add");
            }
            elseif($mon==$mon3)
            {
              $query3="UPDATE m3 set $col='Y' where user_id='$id'";
              $conn->query($query3) or die("couldnt add");
            }
            elseif($mon==$mon4)
            {
              $query4="UPDATE m4 set $col='Y' where user_id='$id'";
              $conn->query($query4) or die("couldnt add");
            }
            else
            {
              echo "<p style='text-align:center;color:red'>Storing data only upto next 3 months.</p>";
            }
            echo "<table id='tableid' style='border:3px solid black;margin:auto;position:relative;top:6%'><tr><th>&emsp;Month&emsp;</th><th>&nbsp;01</th><th>&nbsp;02</th><th>&nbsp;03</th><th>&nbsp;04</th><th>&nbsp;05</th><th>&nbsp;06</th><th>&nbsp;07</th><th>&nbsp;08</th><th>&nbsp;09</th><th>&nbsp;10</th><th>&nbsp;11</th><th>&nbsp;12</th><th>&nbsp;13</th><th>&nbsp;14</th><th>&nbsp;15</th><th>&nbsp;16</th><th>&nbsp;17</th><th>&nbsp;18</th><th>&nbsp;19</th><th>&nbsp;20</th><th>&nbsp;21</th><th>&nbsp;22</th><th>&nbsp;23</th><th>&nbsp;24</th><th>&nbsp;25</th><th>&nbsp;26</th><th>&nbsp;27</th><th>&nbsp;28</th><th>&nbsp;29</th><th>&nbsp;30</th><th>&nbsp;31</th></tr>";
            $query5="SELECT * from m1 where user_id='$id'";
            $f=$conn->query($query5);
            echo "<tr><td>&emsp;$mon1&emsp;</td>";
            while($row = $f->fetch_assoc())
            {
              echo "<td class='y_n'>&nbsp;".$row["day01"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day02"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day03"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day04"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day05"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day06"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day07"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day08"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day09"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day10"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day11"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day12"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day13"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day14"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day15"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day16"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day17"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day18"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day19"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day20"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day21"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day22"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day23"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day24"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day25"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day26"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day27"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day28"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day29"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day30"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day31"]."&nbsp;</td></tr>";
            }
            $query6="SELECT * from m2 where user_id='$id'";
            $f=$conn->query($query6);
            echo "<tr><td>&emsp;$mon2&emsp;</td>";
            while($row = $f->fetch_assoc())
            {
              echo "<td class='y_n'>&nbsp;".$row["day01"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day02"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day03"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day04"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day05"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day06"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day07"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day08"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day09"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day10"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day11"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day12"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day13"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day14"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day15"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day16"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day17"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day18"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day19"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day20"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day21"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day22"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day23"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day24"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day25"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day26"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day27"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day28"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day29"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day30"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day31"]."&nbsp;</td></tr>";
            }
            $query7="SELECT * from m3 where user_id='$id'";
            $f=$conn->query($query7);
            echo "<tr><td>&emsp;$mon3&emsp;</td>";
            while($row = $f->fetch_assoc())
            {
              echo "<td class='y_n'>&nbsp;".$row["day01"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day02"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day03"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day04"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day05"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day06"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day07"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day08"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day09"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day10"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day11"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day12"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day13"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day14"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day15"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day16"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day17"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day18"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day19"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day20"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day21"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day22"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day23"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day24"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day25"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day26"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day27"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day28"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day29"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day30"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day31"]."&nbsp;</td></tr>";
            }
            $query8="SELECT * from m4 where user_id='$id'";
            $f=$conn->query($query8);
            echo "<tr><td>&emsp;$mon4&emsp;</td>";
            while($row = $f->fetch_assoc())
            {
              echo "<td class='y_n'>&nbsp;".$row["day01"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day02"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day03"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day04"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day05"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day06"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day07"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day08"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day09"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day10"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day11"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day12"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day13"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day14"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day15"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day16"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day17"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day18"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day19"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day20"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day21"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day22"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day23"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day24"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day25"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day26"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day27"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day28"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day29"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day30"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day31"]."&nbsp;</td></tr>";
            }
            echo "</table>";
        }
      ?>
    </section>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
  <script type="text/javascript">

  $(document).ready(function()
  {
    $("#tableid td.y_n:contains('N')").css('background-color','#fcc');
    $("#tableid td.y_n:contains('Y')").css('background-color','lightgreen');

  });
  </script>

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
