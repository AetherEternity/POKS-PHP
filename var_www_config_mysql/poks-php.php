<?php
$db=mysqli_connect("127.0.0.1","poksphpapp","PASSWORD-CHANGEME","poks-php");
if(!$db){
    die("Cannot connect to database");
}
function getallbyid($slotid){
    global $db;
    $stmt=$db->prepare("SELECT * FROM chars WHERE id=?");
    $stmt->bind_param("i", $slotid);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_assoc();
}
function movechar($source, $destination){
    global $db;
    $res=getallbyid($source);
    $stmt=$db->prepare("REPLACE INTO chars (id,name,power,health,level,experience,points) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("isiiiii", $destination, $res['name'], $res['power'], $res['health'], $res['level'], $res['experience'], $res['points']);
    $stmt->execute();
}
