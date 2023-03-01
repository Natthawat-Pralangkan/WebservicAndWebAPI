<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include './db.php';
$data = json_decode(file_get_contents("php://input"));
if ($_SERVER['REQUEST_METHOD'] !=='PATCH'){
    echo json_encode(array("status" => "error"));
    die();
}
try {
    $stmt = $dbh->prepare("UPDATE information SET Name=?, details=?, province=?, photo=?, latitude=?, longitude=? WHERE id=?");
    $stmt->bindParam(1, $data->Name);
    $stmt->bindParam(2, $data->details);
    $stmt->bindParam(3, $data->province);
    $stmt->bindParam(4, $data->photo);
    $stmt->bindParam(5, $data->latitude);
    $stmt->bindParam(6, $data->longitude);
    $stmt->bindParam(7, $data->id);
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
