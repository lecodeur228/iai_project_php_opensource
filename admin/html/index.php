<?php
  // @include('./website/config.php');
  $hostname = "localhost";
  $database = "iai_project";
  $username = "root";
  $password = "";

  try {
      $dsn = "mysql:host=$hostname;dbname=$database;charset=utf8";
      $options = [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_EMULATE_PREPARES => false,
      ];

      $db = new PDO($dsn, $username, $password, $options);
  } catch (PDOException $e) {
      echo "Erreur de connexion à la base de données : " . $e->getMessage();
  }
    // code pour avoir le nombre d'etudiants
  $query_etudiants = "SELECT COUNT(*) as totalEtudiants FROM etudiants";
    $stmt = $db->query($query_etudiants);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalEtudiants = $result['totalEtudiants'];

    // code pour avoir le nombre d'etudiansts inscris par sexe
    $query_sexe = "SELECT e.sexe, COUNT(c.etudiant_id) as nombre_candidats FROM etudiants e
    LEFT JOIN candidats c ON e.id = c.etudiant_id
    GROUP BY e.sexe";
    $stmt = $db->query($query_sexe);
    $totaleSexe = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // code pour avoir le nombre d'etudiansts inscris par nationalite
    $query_nat = "SELECT e.nationalite, COUNT(c.etudiant_id) as nombre_candidats FROM etudiants e
    LEFT JOIN candidats c ON e.id = c.etudiant_id
    GROUP BY e.nationalite";
    $stmt = $db->query($query_nat);
    $totaleNat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // code pour avoir le nombre d'etudiansts inscris par serie
    $query_serie = "SELECT e.serie, COUNT(c.etudiant_id) as nombre_candidats FROM etudiants e
    LEFT JOIN candidats c ON e.id = c.etudiant_id
    GROUP BY e.serie";
    $stmt = $db->query($query_serie);
    $totaleSerie = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Requête pour récupérer la liste des étudiants masculins (sexe = 'M') dans la table des candidats
      $query_m = "SELECT etudiants.* FROM etudiants
      INNER JOIN candidats ON etudiants.id = candidats.etudiant_id
      WHERE etudiants.sexe = 'M'";

      $stmt = $db->prepare($query_m);

      // Exécutez la requête
      $stmt->execute();

      // Récupérez les résultats
      $results_m = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Requête pour récupérer la liste des étudiants masculins (sexe = 'F') dans la table des candidats
      $query_f = "SELECT etudiants.* FROM etudiants
      INNER JOIN candidats ON etudiants.id = candidats.etudiant_id
      WHERE etudiants.sexe = 'F'";

      $stmt = $db->prepare($query_f);

      // Exécutez la requête
      $stmt->execute();

      // Récupérez les résultats
      $results_f = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  // Récupérer les valeurs depuis la base de données
$query_get = "SELECT * FROM `date_concours` WHERE `id` = 1";
$stmt = $db->prepare($query_get);
$stmt->execute();
$result_get = $stmt->fetch(PDO::FETCH_ASSOC);

// Stocker les valeurs dans des variables
$date_concour = $result_get['date_concour'];
$date_depot = $result_get['date_limit'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="../assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="../assets/css/portal.css">

</head>

<body class="app">
    <?php @include('../components/header.php')?>

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Dashboard</h1>

                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="app-card-body p-3 p-lg-4">
                            <h3 class="mb-3">Date limite de depot de dossier : <?php echo htmlspecialchars($date_depot); ?> </h3>
                            <h3 class="mb-3">Date du concours :  <?php echo htmlspecialchars($date_concour); ?></h3>
                            <div class="row gx-5 gy-3">

                                <!--//col-->
                                <div class="col-12 col-lg-10 d-flex justify-content-spacebeetwen">
                                    <form action="../controllers/do_date.php" method="post">
                                        <div class="me-4">
                                            <label for="date_con">date du concour :</label>
                                            <input type="date" name="date_concour" class="form-control" value="<?php echo htmlspecialchars($date_concour); ?>" required>
                                        </div>
                                        <div class="me-4">
                                            <label for="date_con"> date limite de dépot :</label>
                                            <input type="date" name="date_depot" class="form-control" value="<?php echo htmlspecialchars($date_depot); ?>" required>
                                        </div>

                                        <button type="submit" class="btn app-btn-primary">Modifier</button>
                                    </form>
                                </div>
                                <!--//col-->
                            </div>
                        </div>
                        <!--//app-card-body-->

                    </div>
                    <!--//inner-->
                </div>
                <!--//app-card-->

                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Etudiants inscrit :</h4>
                                <div class="stats-figure"><?php echo $totalEtudiants ?></div>

                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="#"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->

                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Inscrit par sexe :</h4>
                                <div class="stats-figure"><?php foreach ($totaleSexe as $result) : ?>
                                    <h5><?php echo 'Sexe ' . ucfirst($result['sexe']) . ' : ' . $result['nombre_candidats']; ?>
                                    </h5>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="#"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Inscrit par Nationnalité :</h4>
                                <div class="stats-figure"><?php foreach ($totaleNat as $result) : ?>
                                    <h5 class=" ">
                                        <?php echo '' . ucfirst($result['nationalite']) . ' : ' . $result['nombre_candidats']; ?>
                                    </h5>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Inscrit par serie : </h4>
                                <div class="stats-figure"><?php foreach ($totaleSerie as $result) : ?>
                                    <h5 class="">
                                        <?php echo 'Serie ' . ucfirst($result['serie']) . ' : ' . $result['nombre_candidats']; ?>
                                    </h5>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                </div>
                <!--//row-->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">

                            <div class="app-card-body p-3 p-lg-4">

                                <div class="chart-container">
                                    <canvas id="canvas-linechart"></canvas>
                                </div>
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Bar Chart Example</h4>
                                    </div>
                                    <!--//col-->
                                    <div class="col-auto">
                                        <div class="card-header-action">
                                            <a href="charts.html">More charts</a>
                                        </div>
                                        <!--//card-header-actions-->
                                    </div>
                                    <!--//col-->
                                </div>
                                <!--//row-->
                            </div>
                            <!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="mb-3 d-flex">
                                    <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                        <option value="1" selected>This week</option>
                                        <option value="2">Today</option>
                                        <option value="3">This Month</option>
                                        <option value="3">This Year</option>
                                    </select>
                                </div>
                                <div class="chart-container">
                                    <canvas id="canvas-barchart"></canvas>
                                </div>
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->

                </div>
                <!--//row-->
                <div class="row g-4 mb-4">

                    <!--//col-->

                    <!--//col-->
                </div>
                <!--//row-->


            </div>
            <!--//container-fluid-->
            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">

                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Candidats de sexe : Masculin</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Id</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Nom</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">date de naissance</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"> sexe </h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"> nationalité </h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">serie</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">annee bac</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($results_m as $row) : ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?php echo $row['id']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0 d-flex">

                                                <div class="mx-2">
                                                    <h6 class="fw-semibold mb-1"><?php echo $row['nom']; ?>
                                                        <?php echo $row['prenom']; ?></h6>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?php echo $row['date_nais']; ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span
                                                        class=" rounded-3 fw-semibold"><?php echo $row['sexe']; ?></span>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 fs-4">
                                                    <?php echo $row['nationalite']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 fs-4"><?php echo $row['serie']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 fs-4"><?php echo $row['annee_bac']; ?>
                                                </h6>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch pt-5">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Candidats de sexe : Feminin</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Id</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Nom</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">date de naissance</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"> sexe </h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"> nationalité </h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">serie</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">annee bac</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($results_f as $row) : ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?php echo $row['id']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0 d-flex">

                                                <div class="mx-2">
                                                    <h6 class="fw-semibold mb-1"><?php echo $row['nom']; ?>
                                                        <?php echo $row['prenom']; ?></h6>

                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?php echo $row['date_nais']; ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span
                                                        class=" rounded-3 fw-semibold"><?php echo $row['sexe']; ?></span>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 fs-4">
                                                    <?php echo $row['nationalite']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 fs-4"><?php echo $row['serie']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 fs-4"><?php echo $row['annee_bac']; ?>
                                                </h6>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--//app-content-->



    </div>
    <!--//app-wrapper-->


    <!-- Javascript -->
    <script src="../assets/plugins/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="../assets/plugins/chart.js/chart.min.js"></script>
    <script src="../assets/js/index-charts.js"></script>

    <!-- Page Specific JS -->
    <script src="../assets/js/app.js"></script>

</body>

</html>