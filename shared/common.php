<?php
session_start();
$user = $_SESSION['login_user'];

if($user == null){
    header("location: login.php");
}

$parentName = "";
$parentId = "";

$sql = "SELECT * FROM parents WHERE cellnumber = '$user'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $parentName = $row["Name"]." ".$row["Surname"];
    $parentId = $row["Id"];
  }
} 


if (isset($_POST["btnLogout"])) {

  
}

?>