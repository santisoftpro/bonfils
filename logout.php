<?php

session_start();
unset($_SESSION['stock']);
header("location: index.php");

?>