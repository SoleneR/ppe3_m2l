<?php
    require_once '../data/pdoM2l.php';
    $pdo = PdoM2l::getPdo();
    $lesSalles = $pdo->getLesSalles();
    echo json_encode($lesSalles);

?>