<div class="hero-wrap" style="background-image: url('../images/bg_1.jpg'); background-attachment:fixed;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-8 ftco-animate text-center">
                <h1 class="mb-4">Bienvenu sur le site web de IAI-TOGO</h1>
                
                    <h1>Compte à rebours en jours</h1>
                    <p id="countdown"></p>
                  <form action="./controllers/do_candidature.php" method="post">
                  <button type="submit" class="btn btn-primary px-4 py-3">Faire le dépôt de candidature</button> 
                  </form>
                  <?php 
                  $idToCheck = $_SESSION['user']['id']; // Remplacez cela par l'ID que vous souhaitez vérifier

                  // Requête SQL pour vérifier si l'ID existe
                  $query = "SELECT COUNT(*) as count FROM candidats WHERE etudiant_id = :idToCheck";
                  $stmt = $db->prepare($query);
                  
                  // Binder la valeur de l'ID
                  $stmt->bindParam(':idToCheck', $idToCheck, PDO::PARAM_INT);
                  
                  // Exécuter la requête
                  $stmt->execute();
                  
                  // Récupérer le résultat
                  $result = $stmt->fetch(PDO::FETCH_ASSOC);
                  
                  // Vérifier si l'ID existe
                  if ($result['count'] > 0) {
                      echo "<h3>Votre candidature a été deposer</h3>";
                  } else {
                      echo "";
                  }
                  
                  ?>

            </div>
        </div>
    </div>
</div>
