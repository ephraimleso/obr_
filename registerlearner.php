<?php
include("database.php");
include("common.php");

$grades_str = "";
$query = "SELECT * FROM grades";
$result = mysqli_query($db, $query);
while ($row = mysqli_fetch_row($result)) {
  $grades_str .= "<OPTION VALUE=\"$row[1]\" >$row[1]\n";
}

if (isset($_POST["btnSubmit"])) {
  // get the post records
  $nameSurname = $_POST['txtNameSurname'];
  $email = $_POST['txtEmail'];
  $cellNumber = $_POST['txtCellNumber'];
  $grade = $_POST['ddlGrade'];

  // database insert SQL code
  $sql = "INSERT INTO `learners`(`NameAndSurname`, `EmailAddress`, `Grade`, `ParentID`, `Cellnumber`) VALUES ('$nameSurname', '$email', '$grade',1, '$cellNumber')";

  // insert in database 
  $rs = mysqli_query($db, $sql);

  // if ($rs) {
  //   echo "Learner Records Inserted";
  // }

}
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
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
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
          <li><a class="logout" href="login.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.php"><img src="img/usr.png" class="img-circle" width="80"></a></p>
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
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3>Register a Learner</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <div class="form">
                <form class="cmxform form-horizontal style-form" id="frm_registerlearner" method="post" action="">
                  <div class="form-group ">
                    <div class="col-lg-12">
                      <h4><i class="fa fa-angle-right"></i>Learner Details</h4>
                      <hr>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="txtNameSurname" class="control-label col-lg-2">Name and Surname</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="txtNameSurname" name="txtNameSurname" type="text" minlength="2"
                        required />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ddlGrade" class="control-label col-lg-2">Grade</label>
                    <div class="col-lg-10">
                      <select class=" form-control" name="ddlGrade">
                        <?php echo "$grades_str"; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="txtCellNumber" class="control-label col-lg-2">Cell Number</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="txtCellNumber" name="txtCellNumber" type="text" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="txtEmail" class="control-label col-lg-2">Email</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="txtEmail" name="txtEmail" type="txtEmail" />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-theme" type="submit" name="btnSubmit" data-toggle="modal"
                        data-target="#myModal">Submit</button>
                      <!-- <button class="btn btn-theme04" type="button">Cancel</button> -->
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /form-panel -->
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

  </section>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Learner Registration</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-success">Learner details have been rigstered successfully.</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

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

<script>
  function getSubRoute(val){
    alert(val);
  }
</script>