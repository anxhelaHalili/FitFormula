<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "fitformula";

$conn = mysqli_connect($server,$username,$password,$dbname);


if (!$conn) {
    die("<script>alert('Nuk shkoi me sukses.')</script>");
}

?>


