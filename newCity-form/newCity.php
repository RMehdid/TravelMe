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
                        <form action="form.php" method="post">

                            <div class="input-group mb-3 input-group-lg">
                                <label class="input-group-text" for="continent">Continent</label>
                                <select name="continent" class="form-select" id="continent">
                                    <?php $continents = get_continents();
                                    foreach ($continents as $continent) { ?>
                                        <option value="<?= $continent['idcon'] ?>"><?= $continent['nomcon'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <label class="input-group-text" for="pays">Country</label>
                                <select name="pays" class="form-select" id="pays">
                                    <?php $pays = get_pays();
                                    foreach ($pays as $pay) { ?>
                                        <option value="<?= $pay['nompay'] ?>"><?= $pay['nompay'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group md-3 input-group-lg">
                                <span class="input-group-text" id="inputGroup-sizing-lg">City</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-lg" id="ville" name="ville">
                            </div>

                            <p> </p>
                            <div class="input-group md-3 input-group-lg">
                                <span class="input-group-text">Description</span>
                                <textarea name="description" class="form-control" aria-label="With textarea"
                                    id="description"></textarea>
                            </div>
                            <p> </p>

                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="photos">
                                <label class="input-group-text" for="photos" name="photos">Upload</label>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false" id="hotels">Hotels</button>
                                <ul class="dropdown-menu" style="padding-left: 6px;">
                                <?php $hotels = get_necessaire('hotel');
                                    foreach ($hotels as $hotel) { ?>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?= $hotel['nomnec'] ?>" id="hotel1"
                                                name="hotel1">
                                            <label class="form-check-label" for="hotel1" name="hotel">
                                                <?= $hotel['nomnec'] ?>
                                            </label>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <form action="insert.php" method="post">
                                <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                    id="hotels" name="hotel">
                                <button type="button" class="btn btn-light">Add</button>
                                </form>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false"
                                    id="restaurants">Restaurants</button>
                                <ul class="dropdown-menu" style="padding-left: 6px;">
                                <?php $restaurants = get_necessaire('restaurant');
                                    foreach ($restaurants as $restaurant) { ?>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?= $restaurant['nomnec'] ?>" id="hotel1"
                                                name="hotel1">
                                            <label class="form-check-label" for="hotel1" name="hotel">
                                                <?= $restaurant['nomnec'] ?>
                                            </label>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                    id="restaurants">
                                <button type="button" class="btn btn-light">Add</button>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false" id="gares">Gares</button>
                                <ul class="dropdown-menu" style="padding-left: 6px;">
                                <?php $gares = get_necessaire('gare');
                                foreach ($gares as $gare) { ?>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?= $gare['nomnec'] ?>" id="hotel1" name="hotel1">
                                            <label class="form-check-label" for="hotel1" name="hotel">
                                                <?= $gare['nomnec'] ?>
                                            </label>
                                        </div>
                                    </li>
                                <?php } ?>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                    id="gares">
                                <button type="button" class="btn btn-light">Add</button>
                            </div>

                            <div class="input-group mb-3 input-group-lg">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false" id="aeroports">Airports</button>
                                <ul class="dropdown-menu" style="padding-left: 6px;">
                                <?php $aeroports = get_necessaire('aeroport');
                                    foreach ($aeroports as $aeroport) { ?>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?= $aeroport['nomnec'] ?>" id="aeroport"
                                                name="aeroport">
                                            <label class="form-check-label" for="aeroport" name="aeroport">
                                                <?= $aeroport['nomnec'] ?>
                                            </label>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                    id="aeroports">
                                <button type="button" class="btn btn-light">Add</button>
                            </div>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary">Create</button>
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