<?php
include("database.php");


$id = $_POST['subrouteId'];

$query = "SELECT * FROM subroutes WHERE Id = " . $id;
$result = mysqli_query($db, $query);
while ($row = mysqli_fetch_row($result)) {
    echo $row[1];
}

?>