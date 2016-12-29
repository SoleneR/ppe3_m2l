<?php
require_once '../data/pdoM2l.php';

$start_time = $_REQUEST['start_time'];
$end_time = $_REQUEST['end_time'];
$name = $_REQUEST['name'];
$description = $_REQUEST['description'];



$pdo=PdoM2l::getPdo();
$newReservation=$pdo->addReservation($start_time,$end_time,$name,$description);


echo json_encode($newReservation);



?>