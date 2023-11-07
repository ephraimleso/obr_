<?php
// Open connection to the database
include("database.php");
include("admin_manager.php");

$message_str = "";
$learners_count = 0;
$applications_count = 0;
$watinglist_count = 0;
$allocated_count = 0;
$cancelled_count = 0;
$rejected_count = 0;

$query = "SELECT * FROM learners";
$result = mysqli_query($db, $query);
$learners_count = mysqli_num_rows($result);

/* Application counts */
$query1 = "SELECT * FROM transportapplications where StatusId = 1";
$result1 = mysqli_query($db, $query1);
$watinglist_count = mysqli_num_rows($result1);

$query2 = "SELECT * FROM transportapplications where StatusId = 2";
$result2 = mysqli_query($db, $query2);
$allocated_count = mysqli_num_rows($result2);

$query3 = "SELECT * FROM transportapplications where StatusId = 3";
$result3 = mysqli_query($db, $query3);
$cancelled_count = mysqli_num_rows($result3);

$query4 = "SELECT * FROM transportapplications where StatusId = 4";
$result4 = mysqli_query($db, $query4);
$rejected_count = mysqli_num_rows($result4);

$applications_count = $watinglist_count + $allocated_count + $cancelled_count + $rejected_count ;

/* END Application counts */

/* bus pickups counts */
$perc_bus_1p = 0;
$query5 = "SELECT * FROM transportapplications where BusNumber_pickup in ('1A','1B')";
$result5 = mysqli_query($db, $query5);
$bus1_count_p = mysqli_num_rows($result5);
$perc_bus_1p = round(($bus1_count_p / 35) * 100);

$perc_bus_2p = 0;
$query6 = "SELECT * FROM transportapplications where BusNumber_pickup in ('2A','2B')";
$result6 = mysqli_query($db, $query6);
$bus2_count_p = mysqli_num_rows($result6);
$perc_bus_2p = round(($bus2_count_p / 15) * 100);

$perc_bus_3p = 0;
$query7 = "SELECT * FROM transportapplications where BusNumber_pickup in ('3A','3B')";
$result7 = mysqli_query($db, $query7);
$bus3_count_p = mysqli_num_rows($result7);
$perc_bus_3p = round(($bus3_count_p / 15) * 100);

/* end bus counts */

/* bus droppffs counts */
$perc_bus_1d = 0;
$query5d = "SELECT * FROM transportapplications where BusNumber_dropoff in ('1A','1B')";
$result5d = mysqli_query($db, $query5d);
$bus1_count_d = mysqli_num_rows($result5d);
$perc_bus_1d = round(($bus1_count_d / 35) * 100);

$perc_bus_2d = 0;
$query6d = "SELECT * FROM transportapplications where BusNumber_dropoff in ('2A','2B')";
$result6d = mysqli_query($db, $query6d);
$bus2_count_d = mysqli_num_rows($result6d);
$perc_bus_2d = round(($bus2_count_d / 15) * 100);

$perc_bus_3d = 0;
$query7d = "SELECT * FROM transportapplications where BusNumber_dropoff in ('3A','3B')";
$result7d = mysqli_query($db, $query7d);
$bus3_count_d = mysqli_num_rows($result7d);
$perc_bus_3d = round(($bus3_count_d / 17) * 100);

/* end bus counts */

$message_str = mysqli_error($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Impumelelo High School</title>

  <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet">
</head>

<body>
  <section id="container">
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.php" class="logo"><b>ONLINE<span>BUS</span>REGISTRATION</b></a>
      <!--logo end-->

      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="admin.logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="../img/usr.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><b>
              <?php echo "$adminName"; ?>
            </b></h5>
          <li class="mt">
            <a href="admin.dashboard.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="admin.registerlearner.php">
              <i class="fa fa-user"></i>
              <span>Register a Learner</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="admin.applyfortransport.php">
              <i class="fa fa-bus"></i>
              <span>Apply for Bus Transport</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="admin.reports.php">
              <i class="fa fa-bar-chart"></i>
              <span>Reports</span>
            </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3>Reports</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="col-md-12">
              <div class="content-panel">
                <h3><i class="fa fa-angle-right"></i>Learners [
                  <?php echo "$learners_count" ?>]
                </h3>
                <table class="table table-striped table-advance table-hover">
                  <?php echo "$message_str" ?>
                  <thead>
                    <tr>
                      <th><i class="fa fa-user"></i> Full Name</th>
                      <th class="hidden-phone"><i class="fa fa-mail"></i> Email Address</th>
                      <th><i class="fa fa-phone"></i> Cell Number</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($result)):
                      ; ?>
                      <tr>
                        <td>
                          <?php echo $row[1] ?>
                        </td>
                        <td>
                          <?php echo $row[2] ?>
                        </td>
                        <td>
                          <?php echo $row[5] ?>
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt">
          <div class="col-lg-12">
            <br />
            <div class="col-md-12">
              <div class="content-panel">
                <h3><i class="fa fa-angle-right"></i>Applications [
                  <?php echo "$applications_count" ?>]
                </h3>
                <table class="table table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                    <tr>
                      <td>Allocated</td>
                      <td>Waitinglist</td>
                      <td>Cancelled</td>
                      <td>Total</td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo "$allocated_count" ?>
                      </td>
                      <td>
                        <?php echo "$watinglist_count" ?>
                      </td>
                      <td>
                        <?php echo "$cancelled_count" ?>
                      </td>
                      <td>
                        <?php echo "$applications_count" ?>
                      </td>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <br />
        <br />

        <div class="col-md-4 col-sm-4 mb">
          <div class="green-panel pn">
            <div class="green-header">
              <h3>BUS 1 - Pick Up</h3>
            </div>
            <canvas id="serverstatus03" height="20" width="120"></canvas>
            <h2>
              <?php echo $bus1_count_p ?> / 35
            </h2>
            <h2>
              <?php echo $perc_bus_1p ?>% used
            </h2>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 mb">
          <div class="green-panel pn">
            <div class="green-header">
              <h3>BUS 2 - Pick Up</h3>
            </div>
            <canvas id="serverstatus03" height="20" width="120"></canvas>
            <h2>
              <?php echo $bus2_count_p ?> / 15
            </h2>
            <h2>
              <?php echo $perc_bus_2p ?>% used
            </h2>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 mb">
          <div class="green-panel pn">
            <div class="green-header">
              <h3>BUS 3 - Pick Up</h3>
            </div>
            <canvas id="serverstatus03" height="20" width="120"></canvas>
            <h2>
              <?php echo $bus3_count_p ?> / 15
            </h2>
            <h2>
              <?php echo $perc_bus_3p ?>% used
            </h2>
          </div>
        </div>

        <!--drop offs-->

        <div class="col-md-4 col-sm-4 mb">
          <div class="green-panel pn">
            <div class="green-header">
              <h3>BUS 1 - Drop Off</h3>
            </div>
            <canvas id="serverstatus03" height="20" width="120"></canvas>
            <h2>
              <?php echo $bus1_count_d ?> / 35
            </h2>
            <h2>
              <?php echo $perc_bus_1d ?>% used
            </h2>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 mb">
          <div class="green-panel pn">
            <div class="green-header">
              <h3>BUS 2 - Drop Off</h3>
            </div>
            <canvas id="serverstatus03" height="20" width="120"></canvas>
            <h2>
              <?php echo $bus2_count_d ?> / 15
            </h2>
            <h2>
              <?php echo $perc_bus_2d ?>% used
            </h2>
          </div>
        </div>

        <div class="col-md-4 col-sm-4 mb">
          <div class="green-panel pn">
            <div class="green-header">
              <h3>BUS 3 - Drop Off</h3>
            </div>
            <canvas id="serverstatus03" height="20" width="120"></canvas>
            <h2>
              <?php echo $bus3_count_d ?> / 15
            </h2>
            <h2>
              <?php echo $perc_bus_3d ?>% used
            </h2>
          </div>
        </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="../lib/jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="../lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="../lib/jquery.scrollTo.min.js"></script>
  <script src="../lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="../lib/jquery.sparkline.js"></script>
  <script type="text/javascript" src="../lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="../lib/gritter-conf.js"></script>
  <!--common script for all pages-->
  <script src="../lib/common-scripts.js"></script>
  <script src="../lib/morris-conf.js"></script>
  <!--script for this page-->
  <!-- <script src="../shared/logic.js"></script> -->
  <!--script for this page-->
  <script src="../lib/sparkline-chart.js"></script>
  <script src="../lib/zabuto_calendar.js"></script>

</body>

</html>

<script type="text/javascript">
  function cancelApplication(val) {
    $.ajax({
      type: "POST",
      url: "../shared/cancelApplication.php",
      data: { applicationId: val },
      success: function (data) {
        location.href = window.location.href;
      }
    });
  }

  function allocateApplication(val) {
    $.ajax({
      type: "POST",
      url: "../shared/allocateApplication.php",
      data: { applicationId: val },
      success: function (data) {
        location.href = window.location.href;
      }
    });
  }
</script>