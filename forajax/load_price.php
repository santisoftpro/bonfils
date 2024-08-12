<?php

include("../includes/db.php");

$items = $_GET['items'];

$res = mysqli_query($conn, "SELECT * FROM stock WHERE item = '$items'");

while ($row = mysqli_fetch_array($res)) {
    echo $row['sell'];

}
?>