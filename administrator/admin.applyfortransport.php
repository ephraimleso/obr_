<?php
include("database.php");
include("admin_manager.php");

$grades_str = "";
$parents_str = "";

$query = "SELECT * FROM grades";
$res_grades = mysqli_query($db, $query);
$grades_str .= "<OPTION VALUE=\"0\" >---select---";
while ($row = mysqli_fetch_row($res_grades)) {
  $grades_str .= "<OPTION VALUE=\"$row[1]\" >$row[1]\n";
}

$query = "SELECT * FROM parents";
$parents = mysqli_query($db, $query);
$parents_str .= "<OPTION VALUE=\"0\" >---select---";
while ($row = mysqli_fetch_row($parents)) {
  $parents_str .= "<OPTION VALUE=\"$row[0]\" >$row[1]\n";
}


$message_str = "";
$id = "";
$routes_str_m = "";
$sub_routes_str_m = "";
$bus_number_str_m = "";

$routes_str_a = "";
$sub_routes_str_a = "";
$bus_number_str_a = "";

$routes_str_m = "";
$routes_query = "SELECT * FROM routes";

$res_routes = mysqli_query($db, $routes_query);
$routes_str_m .= "<OPTION VALUE=\"0\" >---select---";
$routes_str_a .= "<OPTION VALUE=\"0\" >---select---";
while ($row = mysqli_fetch_row($res_routes)) {
  $routes_str_m .= "<OPTION VALUE=\"$row[0]\" >$row[1]\n";
  $routes_str_a .= "<OPTION VALUE=\"$row[0]\" >$row[1]\n";
}

//learners
$learners_str = "";
$query = "SELECT * FROM learners where parentID = '$parentId'";
$result = mysqli_query($db, $query);
$learners_str .= "<OPTION VALUE=\"0\" >---select---";
while ($row = mysqli_fetch_row($result)) {
  $learners_str .= "<OPTION VALUE=\"$row[0]\" >$row[1]\n";
}

if (isset($_POST["btnSubmit"])) {
  // get the post records
  $routeId_pickup = $_POST['ddlRoute_m'];
  $subRouteId_pickup = $_POST['ddlSubRoute_m'];
  $busNumber_pickup = $_POST['txtBusNumber_m'];
  $routeId_dropoff = $_POST['ddlRoute_a'];
  $subRouteId_dropoff = $_POST['ddlSubRoute_a'];
  $busNumber_dropoff = $_POST['txtBusNumber_a'];
  $learnerId = $_POST['ddlNameSurname'];
  $newLearner = $_POST['ddlNewLearner'];
  $nextYearGrade = $_POST['ddlGrade'];
  $statusId = 1;
  $date = date("Y-m-d");
  $year = 2024;

  // database insert SQL code
  $sql = "INSERT INTO `transportapplications`(`RouteId_pickup`, `SubRouteId_pickup`, `BusNumber_pickup`, `RouteId_dropoff`, `SubRouteId_dropoff`, 
  `BusNumber_dropoff`, `LearnerId`, `NewLearner`, `NextYearGrade`, `StatusId`, `ApplicationDate`, `ApplicationYear`,`ParentId`)
  VALUES ($routeId_pickup,$subRouteId_pickup,'$busNumber_pickup',$routeId_dropoff,  $subRouteId_dropoff 
  ,'$busNumber_dropoff',$learnerId,'$newLearner',$nextYearGrade,$statusId,'$date',$year,$parentId)";

  // insert in database 
  $rs = mysqli_query($db, $sql);

  if ($rs) {
    $message_str = "<div class=\"alert alert-success\">Application submitted successfully.</div>";
  }
}
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

    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <a href="index.php" class="logo"><b>ONLINE<span>BUS</span>REGISTRATION</b></a>

      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="login.php">Logout</a></li>
        </ul>
      </div>
    </header>

    <aside>
      <div id="sidebar" class="nav-collapse ">
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.php"><img src="../img/usr.png" class="img-circle" width="80"></a></p>
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
        </ul>
      </div>
    </aside>

    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3>Transport Application</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <div class="form">
                <form class="cmxform form-horizontal style-form" id="frm_registerlearner" method="post" action="">
                  <div class="form-group ">
                    <div class="col-lg-12">
                      <h4><i class="fa fa-angle-right"></i>Details</h4>
                      <hr>
                      <?php echo "$message_str"; ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-2 "><b>Learner:</b></label>
                    <div class="col-lg-10">
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlParent" class="control-label col-lg-2">Parent</label>
                    <div class="col-lg-10">
                      <select class=" form-control" name="ddlParent">
                        <?php echo "$parents_str"; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlNameSurname" class="control-label col-lg-2">
                      Name and Surname
                    </label>
                    <div class="col-lg-10">
                      <select class=" form-control" name="ddlNameSurname" onchange="getLearnerDetails(this.value);"
                        required>
                        <?php echo "$learners_str"; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlNewLearner" class="control-label col-lg-2">New learner </label>
                    <div class="col-lg-10">
                      <select class=" form-control" name="ddlNewLearner">
                        <option value="0">---select---</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlGrade" class="control-label col-lg-2">Grade in 2024
                    </label>
                    <div class="col-lg-10">
                      <select class=" form-control" name="ddlGrade">
                        <?php echo "$grades_str"; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <div class="col-lg-12">
                      <b>Morning:</b>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlRoute_m" class="control-label col-lg-2">
                      Number and name of the pick-up point
                    </label>
                    <div class="col-lg-10">
                      <select class=" form-control" name="ddlRoute_m" onchange="getMorningSubRoute(this.value);">
                        <?php echo "$routes_str_m"; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlSubRoute_m" class="control-label col-lg-2">
                      Bus route number
                    </label>
                    <div class="col-lg-10">
                      <select class=" form-control" id="ddlSubRoute_m" name="ddlSubRoute_m"
                        onchange="getMorningBusNumber(this.value);">
                        <!-- <?php echo "$sub_routes_str_m"; ?> -->
                        <option>---select---</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="txtBusNumber_m" class="control-label col-lg-2">
                      Bus number
                    </label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="txtBusNumber_m" name="txtBusNumber_m" type="text"
                        readonly="true" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label class="control-label col-lg-2"><b>Afternoon:</b></label>
                    <div class="col-lg-10">
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlRoute_a" class="control-label col-lg-2">
                      Number and name of the drop-off point
                    </label>
                    <div class="col-lg-10">
                      <select class=" form-control" id="ddlRoute_a" name="ddlRoute_a"
                        onchange="getAfternoonSubRoute(this.value);">
                        <?php echo "$routes_str_a"; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlRouteNumber_a" class="control-label col-lg-2">
                      Bus route number
                    </label>
                    <div class="col-lg-10">
                      <select class=" form-control" id="ddlSubRoute_a" name="ddlSubRoute_a"
                        onchange="getAfternoonBusNumber(this.value);">
                        <option>---select---</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="txtBusNumber_a" class="control-label col-lg-2">
                      Bus number
                    </label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="txtBusNumber_a" name="txtBusNumber_a" type="text"
                        readonly="true" />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-theme" type="submit" name="btnSubmit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </section>
    </section>

  </section>
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="../lib/jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="../lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="../lib/jquery.scrollTo.min.js"></script>
  <script src="../lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="../lib/common-scripts.js"></script>
  <script src="../shared/logic.js"></script>
</body>

</html>