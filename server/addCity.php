<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// require "connect.php";
function insertData()
{
  global $conn;

  $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'voyage';

    $conn= @new mysqli(
        $db_host,
        $db_user,
        $db_password,
        $db_db
    );

  // Retrieve form field values
  $ville = $_POST['ville'];
  $pays = $_POST['pays'];
  $continent = $_POST['continent'];
  $descriptif = $_POST['descriptif'];
  $sites = $_POST['sites'];
  $photos = $_POST['photos'];
  $hotels = $_POST['hotels'];
  $restaurants = $_POST['restaurants'];
  $gares = $_POST['gares'];
  $aeroports = $_POST['aeroports'];


  $stmt = $conn->prepare("INSERT INTO continent (nomcon) VALUES (?)");
  $stmt->bind_param("s", $continent);
  $stmt->execute();

  $idcon = $stmt->insert_id;

  $stmt = $conn->prepare("INSERT INTO pays (nompay, idcon) VALUES (?, ?)");
  $stmt->bind_param("ss", $pays, $idcon);
  $stmt->execute();

  $idpay = $stmt->insert_id;
  // Prepare and execute the SQL query
  $stmt = $conn->prepare("INSERT INTO ville (nomvil, idpay, descvil) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $ville, $idpay, $descriptif);
  $stmt->execute();

  // Retrieve the last inserted ID from 'ville' table
  $idvil = $stmt->insert_id;

  $stmt = $conn->prepare("INSERT INTO site (nomsit, cheminphoto, idvil) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $sites, $photos, $idvil);
  $stmt->execute();

  // Check if any of the necessary fields are filled
  if (!empty($hotels) || !empty($restaurants) || !empty($gares) || !empty($aeroports)) {
    // Prepare and execute the SQL query for inserting into 'necessaire' table
    $stmt = $conn->prepare("INSERT INTO necessaire (idvil, typenec, nomnec) VALUES (?, ?, ?)");

    // Insert 'hotels' into 'necessaire' table
    if (!empty($hotels)) {
      $type = 'hotel';
      $stmt->bind_param("sss", $idvil, $type, $hotels);
      $stmt->execute();
    }

    // Insert 'restaurants' into 'necessaire' table
    if (!empty($restaurants)) {
      $type = 'restaurants';
      $stmt->bind_param("sss", $idvil, $type, $restaurants);
      $stmt->execute();
    }

    // Insert 'gares' into 'necessaire' table
    if (!empty($gares)) {
      $type = 'gares';
      $stmt->bind_param("sss", $idvil, $type, $gares);
      $stmt->execute();
    }

    // Insert 'aeroports' into 'necessaire' table
    if (!empty($aeroports)) {
      $type = 'aeroports';
      $stmt->bind_param("sss", $idvil, $type, $aeroports);
      $stmt->execute();
    }
  }

  // Check if the insertion was successful
  if ($stmt->affected_rows > 0) {
    echo "Data inserted successfully.";
  } else {
    echo "Error inserting data.";
  }

  // Close the statement
  $stmt->close();

  // Close the database connection
  $conn->close();
}

insertData();
?>