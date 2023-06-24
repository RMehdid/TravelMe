<?php

$nec = $_POST['hotel'];
$typenec = 'hotel';
$idvil = $_POST['ville'];

$pdo = new PDO('mysql:host=localhost;dbname=voyage;charset=utf8', 'root', 'root');

$statement = $pdo->prepare("INSERT into necessaire (nomnec, typenec, idvil) values (:nomnec, :typenec, :idvil)");
$statement->bindParam(':nomnec', $nec);
$statement->bindParam(':typenec', $typenec);
$statement->bindParam(':idvil', $idvil);
$statement->execute();
?>