<?php
// Open connection to the database


include("database.php");
session_start();
$error = "";
if (isset($_POST["btnSignin"])) {

  $error = "";
  $myusername = mysqli_real_escape_string($db, $_POST['username']);
  $mypassword = mysqli_real_escape_string($db, $_POST['password']);

  $sql = "SELECT id FROM parents WHERE cellnumber = '$myusername' and Password = '$mypassword'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  //$active = $row['active'];

  $count = mysqli_num_rows($result);

  echo "Database result count is ".$count;
  // If result matched $myusername and $mypassword, table row must be 1 row

  if ($count == 0) {
    $error = "<div class=\"alert alert-danger\">User not found.</div>";
  }

  if ($count == 1) {
    $_SESSION['login_user'] = $myusername;

    header("location: index.php");
  } else {
    $error = "<div class=\"alert alert-danger\">Your Cell Number or Password is invalid.</div>";    
  }
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
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" method="POST">
        <h2 class="form-login-heading">login</h2>
        <div class="login-wrap">
        <?php echo "$error"; ?>
          <br />
          <input type="text" class="form-control" placeholder="Cell Number" name="username" autofocus>
          <br />
          <input type="password" class="form-control" placeholder="Password" name="password">
          <br />
          <!-- <label class="checkbox">
            <input type="checkbox" value="remember-me"> Remember me
            <span class="pull-right">
              <a data-toggle="modal" href="login.php#myModal"> Forgot Password?</a>
            </span>
          </label> -->
          <button class="btn btn-theme btn-block" type="submit" name="btnSignin"><i class="fa fa-lock"></i> SIGN
            IN</button>
          <hr>
          <div class="registration">
            Don't have an account yet?<br />
            <a class="" href="createaccount.php">
              Create an account
            </a>
          </div>
        </div>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelleconny="myModalLabel" role="dialog" tabindex="-1" id="myModal"
          class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
              </div>
              <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off"
                  class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button class="btn btn-theme" type="button">Submit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal -->
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
  </script>
</body>

</html>