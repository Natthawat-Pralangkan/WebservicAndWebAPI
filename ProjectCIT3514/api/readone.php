<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include './db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(array("status" => "error"));
    die();
}
try {
    $id = $_REQUEST['id'];
    $stmt = $dbh->prepare("SELECT * FROM information WHERE id = '$id'");
    $stmt->execute();
    $output = array();
    foreach ($stmt as $row) {
        $user = array(
            'id' => $row['id'],
            'Name' => $row['Name'],
            'details' => $row['details'],
            'province' => $row['province'],
            'photo' => $row['photo'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
        );
        array_push($output, $user);
    }
    echo json_encode($user);
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>>";
    die();
}
