<!-- nav bar -->

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        
            <br><small>Nom du site</small>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <?php
                @include('config.php');
          session_start();

          if (isset($_SESSION['user'])) {
            $data = $_SESSION['user']['nom'];

            
                session_start();
                $etudiant_id = $_SESSION['user']['id'];

                // Vérifiez si l'étudiant a confirmé son inscription
                $query = "SELECT * FROM document_confirmation WHERE etudiant_id = :etudiant_id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':etudiant_id', $etudiant_id);
                $stmt->execute();

                // Si l'étudiant a confirmé son inscription, affichez les informations
                if ($stmt->rowCount() > 0) {
                    $confirmationInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // echo "L'étudiant avec l'ID $etudiant_id a confirmé son inscription.<br>";
                    // echo "Informations de confirmation :<br>";
                    // echo "PDF Naissance: {$confirmationInfo['nais']}<br>";
                    // echo "PDF Nationalité: {$confirmationInfo['nat']}<br>";
                    // echo "PDF Attestation: {$confirmationInfo['attes']}<br>";
                } else {
                    echo "<li class='nav-item cta mx-3'><a href='../website/confirmation_doc.php' class='nav-link'><span>Completer les dossiers</span></a></li>";
                }


            echo "
            <li class='nav-item'><h1 class='text text-primary'>$data</h1></li>";
          }
          else {
            echo "
            <li class='nav-item cta'><a href='../website/register.php' class='nav-link'><span>S'inscrire</span></a></li>
            <li class='nav-item cta mx-3'><a href='../website/login.php' class='nav-link'><span>Se connecter</span></a></li>";
          }
          
          ?>
            </ul>
        </div>
    </div>
</nav>

<!-- end nav bar -->