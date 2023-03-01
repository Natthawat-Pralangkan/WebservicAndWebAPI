<?php


include_once("./function.php");
$objCon = connectDB(); // เชื่อมต่อฐานข้อมูล
$email = mysqli_real_escape_string($objCon, $_POST['email']); // รับค่า username
$password = mysqli_real_escape_string($objCon, $_POST['password']); // รับค่า password

$strSQL = "SELECT * FROM user WHERE email = '$email' AND password = ('$password')";
$objQuery = mysqli_query($objCon, $strSQL);
$row = mysqli_num_rows($objQuery);
if($row) {
    $res = mysqli_fetch_assoc($objQuery);
    $_SESSION['user_login'] = array(
        'id' => $res['id'],
        'email' => $res['email'],
        'password' => $res['password']
    );
    echo '<script>alert("ยินดีต้อนรับคุณ ', $res['email'],'");window.location=".././admin.php";</script>';
} else {
    echo '<script>alert("username หรือ password ไม่ถูกต้อง!!");window.location="login.php";</script>';
}