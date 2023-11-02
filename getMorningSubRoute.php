<?php
include("database.php");


$id = $_POST['routeId'];

$query = "SELECT * FROM subroutes WHERE TripTypeId = 1 AND RouteId = " . $id;
$result = mysqli_query($db, $query);
echo "<OPTION VALUE=\"0\" >---select---";
while ($row = mysqli_fetch_row($result)) {
    echo "<OPTION VALUE=\"$row[0]\" >$row[3] - $row[2]\n";
}

?>