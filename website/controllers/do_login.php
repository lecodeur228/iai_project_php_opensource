<?php
// Inclure le fichier de configuration et la validation si nécessaire
// @include('../validation/login_validation.php');
// @include('./website/config.php');

// Informations de connexion à la base de données
$hostname = "localhost";
$database = "iai_project";
$username = "root";
$password = "";

try {
    // Connexion à la base de données
    $dsn = "mysql:host=$hostname;dbname=$database;charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

// Récupérer les données du formulaire
$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
$mdp = isset($_POST["mdp"]) ? $_POST["mdp"] : "";

// Vérifier si les champs requis sont remplis
if (empty($firstname) || empty($mdp)) {
    header("Location: ../login.php");
    exit;
}

// Préparer et exécuter la requête SQL
$query = "SELECT * FROM etudiants WHERE nom=:nom AND mdp=:mdp";
$stmt = $db->prepare($query);

// Binder les valeurs
$stmt->bindParam(':nom', $firstname);
$stmt->bindParam(':mdp', $mdp);

// Exécuter la requête
$stmt->execute();

// Vérifier le nombre de résultats
if ($stmt->rowCount() == 1) {
    // Récupérer les résultats sous forme de tableau associatif
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    // Démarrer la session et enregistrer l'utilisateur
    session_start();
    $_SESSION['user'] = $results; // Enregistre l'utilisateur dans la session

    // Rediriger vers la page d'accueil
    header("Location: ../index.php");
    exit();
} else {
    // Rediriger vers la page de connexion avec un message d'erreur
    header("Location: ../login.php?error=1");
    exit();
}
?>
