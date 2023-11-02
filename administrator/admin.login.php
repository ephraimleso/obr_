<?php
// Open connection to the database
include("database.php");

session_start();
$error = "";
if (isset($_POST["btnSignin"])) {

  $error = "";
  $myusername = mysqli_real_escape_string($db, $_POST['username']);
  $mypassword = mysqli_real_escape_string($db, $_POST['password']);

  $sql = "SELECT id FROM administrators WHERE EmailAddress = '$myusername' and Password = '$mypassword'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $count = mysqli_num_rows($result);

  if ($count == 0) {
    $error = "<div class=\"alert alert-danger\">User not found.</div>";
  }

  if ($count == 1) {
    $_SESSION['admin_user'] = $myusername;

    header("location: admin.dashboard.php");
  } else {
    $error = "<div class=\"alert alert-danger\">Your Username or Password is not invalid.</div>";
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
  <div id="login-page">
    <div class="container">
      <form class="form-login" method="POST">
        <h2 class="form-login-heading">ADMINISTRATOR login</h2>
        <div class="login-wrap">
          <?php echo "$error"; ?>
          <br />
          <input type="text" class="form-control" placeholder="Email address" name="username" autofocus>
          <br />
          <input type="password" class="form-control" placeholder="Password" name="password">
          <br />
          <button class="btn btn-theme btn-block" type="submit" name="btnSignin"><i class="fa fa-lock"></i>
            SIGN
            IN</button>

        </div>

      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="../text/javascript" src="../lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("../img/login-bg.jpg", {
      speed: 500
    });
  </script>
</body>

</html>