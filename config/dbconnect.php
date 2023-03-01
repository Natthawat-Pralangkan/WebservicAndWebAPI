<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "travel";

$conn = mysqli_connect($server,$user,$password,$db);
$con = new PDO('mysql:host=localhost;dbname=travel',$user,$password);
if(!$conn) {
    die("Connection Failed:".mysqli_connect_error());
}

?>