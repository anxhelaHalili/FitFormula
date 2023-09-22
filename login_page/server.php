<?php


$server= "localhost";
$perdoruesi = "root";
$fjalekalim = "";
$databaza="fitformula";
$errors = array();

$conn = mysqli_connect($server,$perdoruesi,$fjalekalim,$databaza);

if(!$conn)
{
   die("Connetion Failed " . mysqli_connect_error());
}