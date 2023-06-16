<?php
function get_continents()
{
    $pdo = new PDO('mysql:host=localhost;dbname=voyage;charset=utf8', 'root', 'root');

    $statement = $pdo->prepare('SELECT * FROM continent');
    $statement->execute();
    return $statement->fetchAll();
}

function get_pays()
{
    $pdo = new PDO('mysql:host=localhost;dbname=voyage;charset=utf8', 'root', 'root');

    $statement = $pdo->prepare('SELECT * FROM pays');
    $statement->execute();
    return $statement->fetchAll();
}

function get_necessaire($typenec)
{
    $pdo = new PDO('mysql:host=localhost;dbname=voyage;charset=utf8', 'root', 'root');

    $statement = $pdo->prepare("SELECT * FROM necessaire where typenec = :typenec");
    $statement->bindParam(':typenec', $typenec);
    $statement->execute();
    return $statement->fetchAll();
}
?>