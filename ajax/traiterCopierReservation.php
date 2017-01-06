<?php
require_once '../data/pdoM2l.php';
$idReservation = $_REQUEST['idReservation'];
$pdo=PdoM2l::getPdo();
$laReservation=$pdo->copyReservation($idReservation);

echo json_encode($laReservation);

?>