<?php

require_once '../data/pdoM2l.php';   
$name = $_REQUEST['name'];
$pdo = PdoM2l::getPdo();
$lesReservations = $pdo->getLesReservations($name);
echo json_encode($lesReservations);

?>