<?php
session_start();
require_once '../data/pdoM2l.php';

$idReservation = $_REQUEST['idReservation'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
$nom = $_REQUEST['nom'];
$user = $_REQUEST['user'];
$description = $_REQUEST['description'];
$type = $_REQUEST['type'];
$statut = $_REQUEST['statut'];
$dateFinaleStart= strtotime($start);
$dateFinaleEnd= strtotime($end);



$pdo= PdoM2l::getPdo();
$newReservation=$pdo->majReservation($idReservation,$dateFinaleStart,$dateFinaleEnd,$nom,$user,$description,$type,$statut);


echo json_encode($newReservation);


?>