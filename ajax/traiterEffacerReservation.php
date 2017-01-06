<?php
require_once '../data/pdoM2l.php';
$idReservation = $_REQUEST['idReservation'];
$pdo=PdoM2l::getPdo();
$laReservation=$pdo->delReservation($idReservation);

echo json_encode($laReservation);

?>