<?php
require_once '../data/pdoM2l.php';

$start_time = $_REQUEST['start_time'];
$end_time = $_REQUEST['end_time'];
$create_by = $_REQUEST['create_by'];
$name = $_REQUEST['name'];
$type = $_REQUEST['type'];
$description = $_REQUEST['description'];

$pdo= PdoGsbRapports::getPdo();
$newReservation=$pdo->addReservation($start_time,$end_time,$create_by,$name,$type,$description);


echo json_encode($newReservation);



?>