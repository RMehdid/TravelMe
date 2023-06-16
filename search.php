<?php

global $conn;

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'voyage';

$conn = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

$continent = $_GET['continent'];
$country = $_GET['country'];
$site = $_GET['site'];
$ville = $_GET['ville'];

$statement = $pdo->prepare('SELECT * FROM ville JOIN pays ON ville.idpay = pays.idpay JOIN continent ON pays.idcon = continent.idcon JOIN site ON ville.idvil = site.idsit WHERE nomcon = :continent AND nompay = :pays AND nomsit = :site AND nomvil = :ville');
$statement->bindParam(':continent', $continent);
$statement->bindParam(':pays', $pays);
$statement->bindParam(':site', $site);
$statement->bindParam(':ville', $ville);
$statement->execute();
$statement->fetchAll();
?>

<ul class="list-group results">
    <?php foreach ($results as $result) { ?>
        <li class="list-group-item result">
        $result['nomvil'], $result['nompay']
        <div>
            <button type="button" class="btn btn-light">
                <i class="bi bi-pen-fill"></i>
            </button>
            <button type="button" class="btn btn-light">
                <i class="bi bi-trash3-fill"></i>
            </button>
        </div>
    </li>
    <?php } ?>
</ul>