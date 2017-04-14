<?php
require_once '../data/pdoM2l.php';

$start_date = $_REQUEST['start_date'];
$end_date = $_REQUEST['end_date'];
$start_time = $_REQUEST['start_time'];
$end_time = $_REQUEST['end_time'];
$room_id = $_REQUEST['room_id'];
$debut = $start_date." ".$start_time;
$fin = $end_date." ".$end_time;


$dateFinaleStart= strtotime($debut) - 7200;
$dateFinaleEnd= strtotime($fin)- 7200 ;


$pdo=PdoM2l::getPdo();

        
$newReservation=$pdo->verifAddReservation($dateFinaleStart,$dateFinaleEnd,$room_id) ;

echo json_encode($newReservation);



?>