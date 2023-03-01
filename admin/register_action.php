<?php
include_once('./function.php');
$objCon = connectDB();

$data = $_POST;
$name = $data['name'];
$email = $data['email'];
$password = ($data['password']);


$strSQL = "INSERT INTO 
user(
    `name`,
    `email`,
    `password`
  
) VALUES (
    '$name', 
    '$email', 
    '$password'
  
)";

$objQuery = mysqli_query($objCon, $strSQL) or die(mysqli_error($objCon));
if ($objQuery) {
    echo '<script>alert("ลงทะเบียนเรียบร้อยแล้ว");window.location="login.php";</script>';
} else {
    echo '<script>alert("พบข้อผิดพลาด");window.location="register.php";</script>';
}
