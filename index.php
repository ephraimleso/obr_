<?php
// Open connection to the database
include("shared/database.php");
include("shared/common.php");

$select_str = "";
$query = "SELECT * FROM learners where parentID = '$parentId'";
$result = mysqli_query($db, $query);

$apps_query = "CALL get_applications('$parentId')";
$apps_result = mysqli_query($db, $apps_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Impumelelo High School</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
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
          <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="img/usr.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><b>
              <?php echo "$parentName"; ?>
            </b></h5>
          <li class="mt">
            <a href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="registerlearner.php">
              <i class="fa fa-user"></i>
              <span>Register a Learner</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="applyfortransport.php">
              <i class="fa fa-bus"></i>
              <span>Apply for Bus Transport</span>
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
        <h3>Dashboard</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="col-md-12">
              <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                  <h3><i class="fa fa-angle-right"></i> My Learner(s)</h3>
                  <thead>
                    <tr>
                      <th><i class="fa fa-user"></i> Full Name</th>
                      <th class="hidden-phone"><i class="fa fa-envelope"></i> Email Address</th>
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
              <!-- /content-panel -->
            </div>
            <br />
            <div class="col-md-12">
              <div class="content-panel">
                <h3><i class="fa fa-angle-right"></i> My Application(s)</h3>
                <br />
                <table class="table table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                    <tr>
                      <th><i class="fa fa-user"></i> Full Name</th>
                      <th>Pick Up</th>
                      <th>Pick Up Route</th>
                      <th>Bus</th>
                      <th>Drop Off</th>
                      <th>Drop Off Route</th>
                      <th>Bus</th>
                      <th>Status</th>
                      <th>Cancel</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($apps_result)):
                      ; ?>
                      <tr>
                        <td>
                          <?php echo $row[0] ?>
                        </td>
                        <td>
                          <?php echo $row[2] ?>
                        </td>
                        <td>
                          <?php echo $row[4] ?>
                        </td>
                        <td>
                          <?php echo $row['BusNumber_pickup'] ?>
                        </td>
                        <td>
                          <?php echo $row[3] ?>
                        </td>
                        <td>
                          <?php echo $row[5] ?>
                        </td>
                        <td>
                          <?php echo $row['BusNumber_dropoff'] ?>
                        </td>
                        <td
                          style="background-color:<?= ($row['StatusId'] == 1) ? 'yellow' : (($row['StatusId'] == 2) ? 'lime' : 'pink') ?>">
                          <?php echo $row['Status_description'] ?>
                        </td>
                        <td>
                          <button class="btn btn-danger btn-xs" value="<?php echo $row['ID'] ?>"
                            onclick="confirm_cancel(this.value);">
                            <i class="fa fa-close "></i>
                          </button>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
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
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="lib/jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
</body>

</html>

<script type="text/javascript">
  function cancelApplication(val) {
    $.ajax({
      type: "POST",
      url: "shared/cancelApplication.php",
      data: { applicationId: val },
      success: function (data) {
        location.href = window.location.href;
      }
    });
  }

  function confirm_cancel(val) {
    let response = false;
    if (confirm("Are you sure you want to cancel this application?") === true) {
      response = true;
    } else {
      response = false;
    }

    if (Boolean(response) === true) {
      cancelApplication(val);
    }
  }
</script>