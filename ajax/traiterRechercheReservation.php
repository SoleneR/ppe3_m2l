<?php

require_once '../data/pdoM2l.php';   
$pdo = PdoM2l::getPdo();
$name = $_REQUEST['name'];
$lesReservations = $pdo->getLesReservations($name);
echo json_encode($lesReservations);

?>