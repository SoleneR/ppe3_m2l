<?php
session_start();
require_once '../data/pdoM2l.php';

function unix_timestamp($date)
{
	$date = str_replace(array(' ', ':'), '-', $date);
	$c    = explode('-', $date);
	$c    = array_pad($c, 6, 0);
	array_walk($c, 'intval');
 
	return mktime($c[3], $c[4], $c[5], $c[1], $c[2], $c[0]);
}

$idReservation = $_REQUEST['idReservation'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
$nom = $_REQUEST['nom'];
$user = $_REQUEST['user'];
$description = $_REQUEST['description'];
$type = $_REQUEST['type'];
$statut = $_REQUEST['statut'];



$pdo= PdoM2l::getPdo();
$newReservation=$pdo->majReservation($idReservation,  unix_timestamp($start),  unix_timestamp($end),$nom,$user,$description,$type,$statut);


echo json_encode($newReservation);


?>