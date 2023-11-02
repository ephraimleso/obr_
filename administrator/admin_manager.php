<?php
session_start();
$user = $_SESSION['admin_user'];

if($user == null){
    header("location: admin.login.php");
}

$adminName = "";
$adminId = "";

$sql = "SELECT * FROM administrators WHERE EmailAddress = '$user'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $adminName = $row["InitialsAndSurname"];
    $adminId = $row["ID"];
  }
} 


if (isset($_POST["btnLogout"])) {

  
}

?>