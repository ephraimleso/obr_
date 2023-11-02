<?php
include("database.php");


$id = $_POST['applicationId'];

$query = "UPDATE transportapplications SET StatusId = 3 WHERE ID = " . $id;
$result = mysqli_query($db, $query);

?>