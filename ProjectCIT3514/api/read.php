<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include'./db.php';
try{
    $users=array();
    foreach($dbh->query('SELECT * FROM `information`')as $row){
        array_push($users,array(
            'id' => $row['id'],
            'Name' => $row['Name'],
            'details' => $row['details'],
            'province' => $row['province'],
            'photo' => $row['photo'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
          
        ));
    }
    echo  json_encode($users);
    $dbh =null;
}catch (PDOException $e){
    print "Error!: " . $e->getMessage() . "<br/>>";
    die();
}
