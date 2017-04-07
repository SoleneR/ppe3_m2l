<?php
session_start();
require_once '../data/pdoM2l.php';

$idReservation = $_REQUEST['idReservation'];

$pdo= PdoM2l::getPdo();
$laReservation=$pdo->getLaReservation($idReservation);
echo json_encode($laReservation);
?>
