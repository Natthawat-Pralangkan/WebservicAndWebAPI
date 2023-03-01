<?php
function connectDB()
{
    $server = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "travel";

    $objCon = mysqli_connect($server,$userName,$userPassword,$dbName);
    mysqli_set_charset($objCon, "utf8");
    return $objCon;
}