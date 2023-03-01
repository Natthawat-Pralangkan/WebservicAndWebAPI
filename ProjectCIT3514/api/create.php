<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include './db.php';
$data = json_decode(file_get_contents("php://input"));
if ($_SERVER['REQUEST_METHOD'] !=='POST'){
    echo json_encode(array("status" => "error"));
    die;
}
try {
    $stmt = $dbh->prepare("INSERT INTO information (Name, details, province, photo, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $data->Name);
    $stmt->bindParam(2, $data->details);
    $stmt->bindParam(3, $data->province);
    $stmt->bindParam(4, $data->photo);
    $stmt->bindParam(5, $data->latitude);
    $stmt->bindParam(6, $data->longitude);
    if($stmt->execute()){
        echo json_encode(array("status" => "ok"));
    }else{
        echo json_encode(array("status" => "error"));
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>>";
    die();
}
