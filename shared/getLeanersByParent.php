<?php
include("database.php");

$parentId = $_POST['parentId'];

$query = "SELECT * FROM learners where parentID = ".$parentId;
$result = mysqli_query($db, $query);
echo "<OPTION VALUE=\"0\" >---select---";
while ($row = mysqli_fetch_row($result)) {
    echo "<OPTION VALUE=\"$row[0]\" >$row[1]\n";
}

?>