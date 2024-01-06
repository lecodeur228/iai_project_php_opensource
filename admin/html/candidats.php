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
    $query = "SELECT etudiants.* FROM etudiants
          INNER JOIN candidats ON etudiants.id = candidats.etudiant_id";
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
                        <h1 class="app-page-title mb-0">Candidats</h1>
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
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
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
										<?php foreach ($results as $row) : ?>
                                             <tr>
                                                 <td class="border-bottom-0">
                                                     <h6 class="fw-semibold mb-0"><?php echo $row['id']; ?></h6>
                                                 </td>
                                                 <td class="border-bottom-0 d-flex">
                                                     
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
                                             </tr>
                                             <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!--//table-responsive-->

                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                        
                        <!--//app-pagination-->

                    </div>
                    <!--//tab-pane-->

                    <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">

                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">#15346</td>
                                                <td class="cell"><span class="truncate">Lorem ipsum dolor sit amet eget
                                                        volutpat erat</span></td>
                                                <td class="cell">John Sanders</td>
                                                <td class="cell"><span>17 Oct</span><span class="note">2:16 PM</span>
                                                </td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$259.35</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="cell">#15344</td>
                                                <td class="cell"><span class="truncate">Pellentesque diam
                                                        imperdiet</span></td>
                                                <td class="cell">Teresa Holland</td>
                                                <td class="cell"><span class="cell-data">16 Oct</span><span
                                                        class="note">01:16 AM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$123.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="cell">#15343</td>
                                                <td class="cell"><span class="truncate">Vestibulum a accumsan lectus sed
                                                        mollis ipsum</span></td>
                                                <td class="cell">Jayden Massey</td>
                                                <td class="cell"><span class="cell-data">15 Oct</span><span
                                                        class="note">8:07 PM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$199.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td class="cell">#15341</td>
                                                <td class="cell"><span class="truncate">Morbi vulputate lacinia neque et
                                                        sollicitudin</span></td>
                                                <td class="cell">Raymond Atkins</td>
                                                <td class="cell"><span class="cell-data">11 Oct</span><span
                                                        class="note">11:18 AM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$678.26</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--//table-responsive-->
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//tab-pane-->

                    <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">#15345</td>
                                                <td class="cell"><span class="truncate">Consectetur adipiscing
                                                        elit</span></td>
                                                <td class="cell">Dylan Ambrose</td>
                                                <td class="cell"><span class="cell-data">16 Oct</span><span
                                                        class="note">03:16 AM</span></td>
                                                <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                <td class="cell">$96.20</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--//table-responsive-->
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//tab-pane-->
                    <div class="tab-pane fade" id="orders-cancelled" role="tabpanel"
                        aria-labelledby="orders-cancelled-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="cell">#15342</td>
                                                <td class="cell"><span class="truncate">Justo feugiat neque</span></td>
                                                <td class="cell">Reina Brooks</td>
                                                <td class="cell"><span class="cell-data">12 Oct</span><span
                                                        class="note">04:23 PM</span></td>
                                                <td class="cell"><span class="badge bg-danger">Cancelled</span></td>
                                                <td class="cell">$59.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--//table-responsive-->
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//tab-pane-->
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