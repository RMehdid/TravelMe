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
  $description = $_POST['description'];
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
  $stmt->bind_param("sss", $ville, $idpay, $description);
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>New city</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="stylesheet" href="newCity.css" />
</head>

<body>
    <div class="layer"></div>
    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3 style="color: #fff;">Create a new city</h3>
                        <p style="color: #fff;">Fill in the data below.</p>
                        <form class="requires-validation" novalidate>

                            <div class="input-group mb-3 input-group-lg">
                                <label class="input-group-text" for="continent">Continent</label>
                                <select class="form-select" id="continent">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <label class="input-group-text" for="pays">Country</label>
                                <select class="form-select" id="pays">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="input-group md-3 input-group-lg">
                                <span class="input-group-text" id="inputGroup-sizing-lg">City</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-lg" id="ville">
                            </div>

                            <p> </p>
                            <div class="input-group md-3 input-group-lg">
                                <span class="input-group-text">Description</span>
                                <textarea class="form-control" aria-label="With textarea" id="description"></textarea>
                            </div>
                            <p> </p>

                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="photos">
                                <label class="input-group-text" for="photos">Upload</label>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false" id="hotels">Hotels</button>
                                <ul class="dropdown-menu" style="padding-left: 6px;">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="hotel1">
                                            <label class="form-check-label" for="hotel1">
                                                Hotel 1
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="hotel2">
                                            <label class="form-check-label" for="hotel2">
                                                Hotel 2
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="hotel3">
                                            <label class="form-check-label" for="hotel3">
                                                Hotel 3
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button" id="hotels">
                                <button type="button" class="btn btn-light">Add</button>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false" id="restaurants">Restaurants</button>
                                <ul class="dropdown-menu" style="padding-left: 6px;">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="resto1">
                                            <label class="form-check-label" for="resto1">
                                                Restaurant 1
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="resto2">
                                            <label class="form-check-label" for="resto2">
                                                Restaurant 2
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="resto3">
                                            <label class="form-check-label" for="resto3">
                                                Restaurant 3
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button" id="restaurants">
                                <button type="button" class="btn btn-light">Add</button>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false" id="gares">Gares</button>
                                <ul class="dropdown-menu" style="padding-left: 6px;">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="gare1">
                                            <label class="form-check-label" for="gare1">
                                                Gare 1
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="gare2">
                                            <label class="form-check-label" for="gare2">
                                                Gare 2
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="gare3">
                                            <label class="form-check-label" for="gare3">
                                                Gare 3
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button" id="gares">
                                <button type="button" class="btn btn-light">Add</button>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false" id="aeroports">Airports</button>
                                <ul class="dropdown-menu" style="padding-left: 6px;">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="airoport1">
                                            <label class="form-check-label" for="airoport1">
                                                Airport 1
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="airoport2">
                                            <label class="form-check-label" for="airoport2">
                                                Airport 2
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="airoport3">
                                            <label class="form-check-label" for="airoport3">
                                                Airport 3
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button" id="aeroports">
                                <button type="button" class="btn btn-light">Add</button>
                            </div>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary" onclick="insertData()">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="newCity.js"></script>
</body>

</html>