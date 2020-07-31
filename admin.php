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

  <!-- Vendor CSS Files-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File-->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/admin.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-11 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="index.html">Techinquiri</a></h1>

          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li class="active"><a href="#remove">Members</a></li>
              <li><a href="#chapter">Chapters</a></li>
              <li><a href="#adminview">Availability</a></li>
              <li><a href="personal.html">Logout</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Members======= -->
    <section id="remove" style="height:100vh; width:100vw">
      <br>
      <div class="container" data-aos="fade-up" style="overflow:scroll;padding:4%;">
        <header class="section-header">
            <h3>Member Details</h3>
            <div data-aos='fade-up'>
            <?php
                include("dbconnect.php");
                $sql = "SELECT * FROM member";
                $name = $conn->query($sql) or die("Couldn't Fetch");
                echo "<table style='border:3px solid black;margin:auto;position:relative;top:15%'><tr><th>&emsp;&emsp;USER_ID&emsp;&emsp;&emsp;</th><th>&emsp;&emsp;Name&emsp;&emsp;</th><th>&emsp;&emsp;Mobile&emsp;&emsp;</th><th>&emsp;&emsp;City&emsp;&emsp;</th><th>&emsp;&emsp;Email-Id&emsp;&emsp;</th></tr>";
                while($row = $name->fetch_assoc())
                {
                    echo "<tr><td>&nbsp;".$row["user_id"]."&nbsp;</td><td>&nbsp;".$row["name"]."&nbsp;</td><td>&nbsp;".$row["mobile"]."&nbsp;</td><td>&nbsp;".$row["city"]."&nbsp;</td><td>&nbsp;".$row["email"]."</td></tr>";
                }
                echo "</table>";
            ?>
            </div>
        </header>
        <br>
      </div>
      <br><br>
      <div class="container" data-aos="fade-up">
        <form action='' method="post" role="form" autocomplete="off">
          <div class="form-group">
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="UserId to be deleted" required/>
          </div>
          <div class="text-center"><button class="btn btn-info" name="delete" type="submit">Delete</button></div>
        </form>
        <?php
          include("dbconnect.php");
          if(isset($_POST['delete']))
          {
            $id=$_POST['user_id'];
            $idcheck=array();
            $query1="SELECT user_id from member";
            $data=$conn->query($query1) or die("Error, Try again later.");
            while($row = $data->fetch_assoc())
            {
              $temp = $row["user_id"];
              array_push($idcheck,"$temp");
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
              echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>This userid does not exist in the database.</p>";
            }
            else
            {
              $query1="DELETE from member where user_id='$id'";
              $name = $conn->query($query1) or die("Couldn't Fetch");
              echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>$id deleted.</p>";
            }
          }
        ?>
      </div>
    </section>

    <!-- =======Chapters======= -->
    <section id="chapter">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h3>Chapter Details</h3>
        </header>
      </div>
      <br>
      <div class="container" data-aos="fade-up">
        <form action='' method="post" role="form" autocomplete="off">
          <div class="form-group">
            <input type="text" class="form-control" name="city" id="city" placeholder="City" required/>
          </div>
          <div class="text-center"><button class="btn btn-info" name="add" type="submit">Add City</button></div>
        </form>
        <?php
          include("dbconnect.php");
          if(isset($_POST['add']))
          {
            $city=$_POST['city'];
            $c=array();
            $query1="SELECT city from chapter";
            $data=$conn->query($query1) or die("Error, Try again later.");
            while($row = $data->fetch_assoc())
            {
              $temp = $row["city"];
              array_push($c,"$temp");
            }
            $flag=0;
            for($j=0;$j<sizeof($c);$j++)
            {
              if($city==$c[$j])
              {
                $flag=1;
                break;
              }
            }
            if($flag==1)
            {
              echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>Techinquiri already has its reach in $city</p>";
            }
            else
            {
              $query2="INSERT into chapter(city) values('$city')";
              $conn->query($query2) or die("Couldn't Fetch");
              echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>$city added.</p>";
            }
          }
        ?>
      </div>

      <br><br>

      <div class="container" data-aos="fade-up">
        <form action='' method="post" role="form" autocomplete="off">
          <div class="form-group">
            <input type="text" class="form-control" name="city" id="city" placeholder="City" required/>
          </div>
          <div class="text-center"><button class="btn btn-info" name="remove" type="submit">Remove City</button></div>
        </form>
        <?php
          include("dbconnect.php");
          if(isset($_POST['remove']))
          {
            $city=$_POST['city'];
            $c=array();
            $query1="SELECT city from chapter";
            $data=$conn->query($query1) or die("Error, Try again later.");
            while($row = $data->fetch_assoc())
            {
              $temp = $row["city"];
              array_push($c,"$temp");
            }
            $flag=0;
            for($j=0;$j<sizeof($c);$j++)
            {
              if($city==$c[$j])
              {
                $flag=1;
                break;
              }
            }
            if($flag==0)
            {
              echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>Techinquiri does not have its reach in $city. Can't be deleted.</p>";

            }
            else
            {
              $query1="DELETE from chapter where city='$city'";
              $name = $conn->query($query1) or die("Couldn't Fetch");
              echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>$city removed.</p>";
            }
          }
        ?>
      </div>

      <br><br>

      <div class="container" data-aos="fade-up" style="overflow:scroll">
        <form action='' method="post" role="form" autocomplete="off">
          <div class="form-group">
            <input type="text" class="form-control" name="city" id="city" placeholder="City" required/>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="New Chapter Head" required/>
          </div>
          <div class="text-center"><button class="btn btn-info" name="update" type="submit">Update Chapter-Head</button></div>
        </form>
        <?php
          include("dbconnect.php");
          if(isset($_POST['update']))
          {
            $id=$_POST['user_id'];
            $city=$_POST['city'];
            $idcheck=array();
            $query1="SELECT user_id from info";
            $data=$conn->query($query1) or die("Error, Try again later.");
            while($row = $data->fetch_assoc())
            {
              $temp = $row["user_id"];
              array_push($idcheck,"$temp");
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
              echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>This userid does not exist in the database.</p>";
            }
            else
            {
              $query1="UPDATE chapter SET head='$id' where city='$city'";
              $name = $conn->query($query1) or die("Couldn't Fetch");
              echo "<p style='background-color:white;opacity:1;text-align:center;color:red'>Chapter Head Updated</p>";
            }
          }
        ?>
      </div>
    </section>

    <section id="adminview">
      <br>
      <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h3>Member Availability</h3>
            <?php
              include("dbconnect.php");
              echo "<h4 style='text-align:center'>Month1</h4>";
              echo "<div data-aos='fade-up'>";
              $sql = "SELECT * FROM m1";
              $m1 = $conn->query($sql) or die("Couldn't Fetch");
              echo "<table id='tableid1' style='border:3px solid black;margin:auto;position:relative;top:6%'><tr><th>&emsp;UserID&emsp;</th><th>&nbsp;01</th><th>&nbsp;02</th><th>&nbsp;03</th><th>&nbsp;04</th><th>&nbsp;05</th><th>&nbsp;06</th><th>&nbsp;07</th><th>&nbsp;08</th><th>&nbsp;09</th><th>&nbsp;10</th><th>&nbsp;11</th><th>&nbsp;12</th><th>&nbsp;13</th><th>&nbsp;14</th><th>&nbsp;15</th><th>&nbsp;16</th><th>&nbsp;17</th><th>&nbsp;18</th><th>&nbsp;19</th><th>&nbsp;20</th><th>&nbsp;21</th><th>&nbsp;22</th><th>&nbsp;23</th><th>&nbsp;24</th><th>&nbsp;25</th><th>&nbsp;26</th><th>&nbsp;27</th><th>&nbsp;28</th><th>&nbsp;29</th><th>&nbsp;30</th><th>&nbsp;31</th></tr>";
              while($row = $m1->fetch_assoc())
              {
                echo "<tr><td>&nbsp;".$row["user_id"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day01"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day02"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day03"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day04"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day05"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day06"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day07"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day08"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day09"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day10"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day11"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day12"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day13"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day14"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day15"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day16"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day17"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day18"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day19"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day20"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day21"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day22"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day23"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day24"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day25"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day26"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day27"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day28"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day29"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day30"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day31"]."&nbsp;</td></tr>";
              }
              echo "</table></div><br><br>";


              echo "<h4 style='text-align:center'>Month2</h4>";
              echo "<div data-aos='fade-up'>";
              $sql = "SELECT * FROM m2";
              $m2 = $conn->query($sql) or die("Couldn't Fetch");
              echo "<table id='tableid2' style='border:3px solid black;margin:auto;position:relative;top:6%'><tr><th>&emsp;UserID&emsp;</th><th>&nbsp;01</th><th>&nbsp;02</th><th>&nbsp;03</th><th>&nbsp;04</th><th>&nbsp;05</th><th>&nbsp;06</th><th>&nbsp;07</th><th>&nbsp;08</th><th>&nbsp;09</th><th>&nbsp;10</th><th>&nbsp;11</th><th>&nbsp;12</th><th>&nbsp;13</th><th>&nbsp;14</th><th>&nbsp;15</th><th>&nbsp;16</th><th>&nbsp;17</th><th>&nbsp;18</th><th>&nbsp;19</th><th>&nbsp;20</th><th>&nbsp;21</th><th>&nbsp;22</th><th>&nbsp;23</th><th>&nbsp;24</th><th>&nbsp;25</th><th>&nbsp;26</th><th>&nbsp;27</th><th>&nbsp;28</th><th>&nbsp;29</th><th>&nbsp;30</th><th>&nbsp;31</th></tr>";
              while($row = $m2->fetch_assoc())
              {
                echo "<tr><td >&nbsp;".$row["user_id"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day01"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day02"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day03"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day04"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day05"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day06"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day07"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day08"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day09"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day10"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day11"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day12"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day13"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day14"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day15"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day16"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day17"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day18"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day19"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day20"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day21"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day22"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day23"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day24"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day25"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day26"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day27"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day28"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day29"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day30"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day31"]."&nbsp;</td></tr>";
              }
              echo "</table></div><br><br>";


              echo "<h4 style='text-align:center'>Month3</h4>";
              echo "<div data-aos='fade-up'>";
              $sql = "SELECT * FROM m3";
              $m3 = $conn->query($sql) or die("Couldn't Fetch");
              echo "<table id='tableid3' style='border:3px solid black;margin:auto;position:relative;top:6%'><tr><th>&emsp;UserID&emsp;</th><th>&nbsp;01</th><th>&nbsp;02</th><th>&nbsp;03</th><th>&nbsp;04</th><th>&nbsp;05</th><th>&nbsp;06</th><th>&nbsp;07</th><th>&nbsp;08</th><th>&nbsp;09</th><th>&nbsp;10</th><th>&nbsp;11</th><th>&nbsp;12</th><th>&nbsp;13</th><th>&nbsp;14</th><th>&nbsp;15</th><th>&nbsp;16</th><th>&nbsp;17</th><th>&nbsp;18</th><th>&nbsp;19</th><th>&nbsp;20</th><th>&nbsp;21</th><th>&nbsp;22</th><th>&nbsp;23</th><th>&nbsp;24</th><th>&nbsp;25</th><th>&nbsp;26</th><th>&nbsp;27</th><th>&nbsp;28</th><th>&nbsp;29</th><th>&nbsp;30</th><th>&nbsp;31</th></tr>";
              while($row = $m3->fetch_assoc())
              {
                echo "<tr><td>&nbsp;".$row["user_id"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day01"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day02"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day03"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day04"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day05"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day06"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day07"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day08"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day09"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day10"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day11"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day12"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day13"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day14"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day15"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day16"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day17"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day18"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day19"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day20"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day21"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day22"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day23"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day24"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day25"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day26"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day27"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day28"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day29"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day30"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day31"]."&nbsp;</td></tr>";
              }
              echo "</table></div><br><br>";


              echo "<h4 style='text-align:center'>Month4</h4>";
              echo "<div data-aos='fade-up'>";
              $sql = "SELECT * FROM m4";
              $m4 = $conn->query($sql) or die("Couldn't Fetch");
              echo "<table id='tableid4' style='border:3px solid black;margin:auto;position:relative;top:6%'><tr><th>&emsp;UserID&emsp;</th><th>&nbsp;01</th><th>&nbsp;02</th><th>&nbsp;03</th><th>&nbsp;04</th><th>&nbsp;05</th><th>&nbsp;06</th><th>&nbsp;07</th><th>&nbsp;08</th><th>&nbsp;09</th><th>&nbsp;10</th><th>&nbsp;11</th><th>&nbsp;12</th><th>&nbsp;13</th><th>&nbsp;14</th><th>&nbsp;15</th><th>&nbsp;16</th><th>&nbsp;17</th><th>&nbsp;18</th><th>&nbsp;19</th><th>&nbsp;20</th><th>&nbsp;21</th><th>&nbsp;22</th><th>&nbsp;23</th><th>&nbsp;24</th><th>&nbsp;25</th><th>&nbsp;26</th><th>&nbsp;27</th><th>&nbsp;28</th><th>&nbsp;29</th><th>&nbsp;30</th><th>&nbsp;31</th></tr>";
              while($row = $m4->fetch_assoc())
              {
                echo "<tr><td>&nbsp;".$row["user_id"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day01"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day02"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day03"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day04"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day05"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day06"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day07"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day08"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day09"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day10"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day11"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day12"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day13"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day14"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day15"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day16"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day17"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day18"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day19"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day20"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day21"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day22"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day23"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day24"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day25"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day26"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day27"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day28"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day29"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day30"]."&nbsp;</td><td class='y_n'>&nbsp;".$row["day31"]."&nbsp;</td></tr>";
              }
              echo "</table></div><br><br>";
            ?>
        </header>
        <br>
      </div>
    </section>
  </main><!-- End #main -->



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


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
  <script type="text/javascript">

  $(document).ready(function()
  {
    $("#tableid1 td.y_n:contains('N')").css('background-color','#fcc');
    $("#tableid1 td.y_n:contains('Y')").css('background-color','lightgreen');
  });

  $(document).ready(function()
  {
    $("#tableid2 td.y_n:contains('N')").css('background-color','#fcc');
    $("#tableid2 td.y_n:contains('Y')").css('background-color','lightgreen');

  });

  $(document).ready(function()
  {
    $("#tableid3 td.y_n:contains('N')").css('background-color','#fcc');
    $("#tableid3 td.y_n:contains('Y')").css('background-color','lightgreen');

  });

  $(document).ready(function()
  {
    $("#tableid4 td.y_n:contains('N')").css('background-color','#fcc');
    $("#tableid4 td.y_n:contains('Y')").css('background-color','lightgreen');

  });
  </script>


</body>

</html>
