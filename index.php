<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>iTravel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <link rel="stylesheet" href="/main.css" />
</head>

<body id="body-pd">
  <div id="viewport">
    <!-- Sidebar -->
    <div id="sidebar">
      <header>
        <a href="#">Etudiant</a>
      </header>
      <div class="navbar" style="color: white; padding: 16px">
        <div class="user-infos">
          <p class="user-info">Nom: Toto</p>
          <p class="user-info">Prenom: Tutu</p>
          <p class="user-info">Specialite: T1</p>
          <p class="user-info">Section: 1</p>
          <p class="user-info">Groupe: 2</p>
          <p class="user-info">Mail: t.toto@mail.dz</p>
        </div>
        <div class="nav-line-div"></div>
        <a class="btn btn-primary" href="/newCity-form/newCity.php" role="button">Add a new city</a>
      </div>
    </div>
    <!-- Content -->
    <div class="main-content">
      <h1 class="title">iTravel the world</h1>
      <div class="content">
        <form action="index.php" method="get">
          <div class="search-fields">
            <div class="row">
              <div class="col input-group mb-3">
                <span class="input-group-text" id="continent">Continent</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="continent"
                  id="continent" name="continent" />
              </div>

              <div class="col input-group mb-3">
                <span class="input-group-text" id="site">Site</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="site"
                  id="site" name="site" />
              </div>
            </div>

            <div class="row">
              <div class="col input-group mb-3">
                <span class="input-group-text" id="country">Country</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="country"
                  id="country" name="country" />
              </div>

              <div class="col input-group mb-3">
                <span class="input-group-text" id="ville">Ville</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="ville"
                  id="ville" name="ville" />
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary float-lg-end">
            Search
          </button>
        </form>

        <ul class="list-group results">
          <?php foreach ($results as $result) { ?>
            <li class="list-group-item result">
              <?php echo $result['nomvil'] . ', ' . $result['nompay']; ?>
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
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="/main.js"></script>
</body>

</html>

<?php
// Check if the search form has been submitted
if (isset($_GET['continent']) || isset($_GET['site']) || isset($_GET['country']) || isset($_GET['ville'])) {
  // Get the search terms from the form fields
  $continent = $_GET['continent'] ?? '';
  $site = $_GET['site'] ?? '';
  $country = $_GET['country'] ?? '';
  $ville = $_GET['ville'] ?? '';

  $pdo = new PDO('mysql:host=localhost;dbname=voyage;charset=utf8', 'root', 'root');

  $statement = $pdo->prepare('SELECT * FROM ville, pays, continent, site WHERE
      ville.idpay = pays.idpay
      AND pays.idcon = continent.idcon
      AND site.idvil = ville.idvil
  AND (nomcon = :continent 
   OR nompay = :country 
   OR nomsit = :site 
   OR nomvil = :ville)');
  $statement->bindParam(':continent', $continent);
  $statement->bindParam(':country', $country);
  $statement->bindParam(':site', $site);
  $statement->bindParam(':ville', $ville);
  $statement->execute();

  $results = $statement->fetchAll();
}
?>