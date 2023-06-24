<?php

    $results = array(); // Initialize an empty array

    // Check if the search form has been submitted
    if (isset($_GET['continent']) || isset($_GET['site']) || isset($_GET['country']) || isset($_GET['ville'])) {
        // Get the search terms from the form fields
        $continent = $_GET['continent'] ?? '';
        $site = $_GET['site'] ?? '';
        $country = $_GET['country'] ?? '';
        $ville = $_GET['ville'] ?? '';

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=voyage;charset=utf8', 'root', 'root');

            $statement = $pdo->prepare('SELECT * FROM ville JOIN pays ON ville.idpay = pays.idpay JOIN continent ON pays.idcon = continent.idcon JOIN site ON ville.idvil = site.idsit WHERE nomcon = :continent OR nompay = :country OR nomsit = :site OR nomvil = :ville');
            $statement->bindParam(':continent', $continent);
            $statement->bindParam(':country', $country);
            $statement->bindParam(':site', $site);
            $statement->bindParam(':ville', $ville);
            $statement->execute();

            $results = $statement->fetchAll();
        } catch (PDOException $e) {
            // Handle the database connection or query error
            // Display an error message or log the error
            // You can customize this part to match your error handling approach
            echo 'Error: ' . $e->getMessage();
        }
    }
?>
