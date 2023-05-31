<?php

require "connect.php";

  connect();
  function insertData() {
    global $conn;

    // Retrieve form field values
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $continent = $_POST['continent'];
    $descriptif = $_POST['descriptif'];
    $sites = $_POST['sites'];
    $hotels = $_POST['hotels'];
    $restaurants = $_POST['restaurants'];
    $gares = $_POST['gares'];
    $aeroports = $_POST['aeroports'];

    echo $_POST['hotels'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO ville (ville, pays, continent, descriptif, sites, hotels, restaurants, gares, aeroports) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $ville, $pays, $continent, $descriptif, $sites, $hotels, $restaurants, $gares, $aeroports);
    $stmt->execute();

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

  $mysqli->close();
?>
