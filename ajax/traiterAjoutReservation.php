<?php
require_once '../data/pdoM2l.php';

$start_date = $_REQUEST['start_date'];
$end_date = $_REQUEST['end_date'];
$start_time = $_REQUEST['start_time'];
$end_time = $_REQUEST['end_time'];
$room_id = $_REQUEST['room_id'];
$name = $_REQUEST['name'];
$types = $_REQUEST['types'];
$description = $_REQUEST['description'];
$statut = $_REQUEST['statut'];
$debut = $start_date." ".$start_time;
$fin = $end_date." ".$end_time;
$dateFinaleStart= strtotime($debut);
$dateFinaleEnd= strtotime($fin);



$pdo=PdoM2l::getPdo();
$newReservation=$pdo->addReservation($dateFinaleStart,$dateFinaleEnd,$room_id,$name,$types,$description,$statut);


echo json_encode($newReservation);



?>