<?php
require_once '../data/pdoM2l.php';

$id_salle = $_REQUEST['salle'];
$dateJour = $_REQUEST['dateJour'];

$pdo=PdoM2l::getPdo();
$evenement=$pdo->getEvenement($id_salle,$dateJour);
echo json_encode($evenement);
?>