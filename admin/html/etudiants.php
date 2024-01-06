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
    $query = "SELECT etudiants.*, document_confirmation.*
    FROM etudiants
    INNER JOIN document_confirmation ON etudiants.id = document_confirmation.etudiant_id";
    $stmt = $db->prepare($query);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer les résultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>admin</title>

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

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Etudiants</h1>
                    </div>
                    <div class="col-auto">

                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->





                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                        aria-labelledby="orders-all-tab">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4">Liste de tous les étudiants</h5>
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
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Naissance</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nationalite</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Attestation</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Validation</h6>
                                                </th>
                                                <!-- Add similar th elements for other columns -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($results as $row) : ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"><?php echo $row['id']; ?></h6>
                                                </td>
                                                <td class="border-bottom-0 d-flex">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <!-- Your image tag and other content -->
                                                    </div>
                                                    <div class="mx-2">
                                                        <h6 class="fw-semibold mb-1"><?php echo $row['nom']; ?></h6>
                                                        <span class="fw-normal"><?php echo $row['prenom']; ?></span>
                                                    </div>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo $row['date_nais']; ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span
                                                            class="badge bg-primary rounded-3 fw-semibold"><?php echo $row['sexe']; ?></span>
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
                                                <td class="border-bottom-0">
                                                    <a target="_blank" href="http://localhost/iai_project_php/website/controllers/<?php echo $row['nais']; ?>" class="btn btn-warning" class="fw-semibold mb-0 fs-4">Voir PDF
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href="http://localhost/iai_project_php/website/controllers/<?php echo $row['nat']; ?>" class="btn btn-warning" class="fw-semibold mb-0 fs-4">Voir PDF
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href="http://localhost/iai_project_php/website/controllers/<?php echo $row['attes']; ?>" class="btn btn-warning" class="fw-semibold mb-0 fs-4">Voir PDF
                                                    </h6>
                                                </td>
                                               
                                                
                                                <?php if ($row['validate'] === 0): ?>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-danger rounded-3 fw-semibold">Pas encore</span>
                                                    </div>
                                                </td>
                                                <?php else: ?>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-success rounded-3 fw-semibold">OK</span>
                                                    </div>
                                                </td>
                                                <?php endif; ?>
                                                <?php if ($row['validate'] === 0): ?>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="btn btn-success rounded-3 fw-semibold">Valider</span>
                                                    </div>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add similar sections for other tabs: orders-paid, orders-pending, orders-cancelled -->
                </div>

                <!--//tab-content-->



            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-content-->


    </div>
    <!--//app-wrapper-->


    <!-- Javascript -->
    <script src="../assets/plugins/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>


    <!-- Page Specific JS -->
    <script src="../assets/js/app.js"></script>

</body>

</html>