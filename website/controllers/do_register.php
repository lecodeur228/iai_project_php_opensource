<?php  
@include('../validation/register_validation.php');
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


$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
$birthday = isset($_POST["birthday"]) ? $_POST["birthday"] : "";
$country = isset($_POST["country"]) ? $_POST["country"] : "";
$serie = isset($_POST["serie"]) ? $_POST["serie"] : "";
$sexe = isset($_POST["sexe"]) ? $_POST["sexe"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$image = isset($_POST["image"]) ? $_POST["image"] : "";
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Vérifier si le fichier image est une image réelle ou une fausse image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
}

// Vérifier si le fichier existe déjà
if (file_exists($targetFile)) {
    echo "Désolé, le fichier existe déjà.";
    $uploadOk = 0;
}

// Vérifier la taille du fichier (ici, limitée à 2 Mo)
if ($_FILES["image"]["size"] > 2000000) {
    echo "Désolé, le fichier est trop volumineux.";
    $uploadOk = 0;
}

// Autoriser certains formats de fichiers
$allowedExtensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowedExtensions)) {
    echo "Désolé, seulement les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
}

// Vérifier si $uploadOk est défini à 0 par une erreur
if ($uploadOk == 0) {
    echo "Désolé, le fichier n'a pas été téléchargé.";
} else {
    // Si tout est correct, essayer d'uploader le fichier
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Le fichier ". htmlspecialchars(basename($_FILES["image"]["name"])). " a été téléchargé.";

         // Préparer la requête d'insertion avec le nom du fichier image
    $query = "INSERT INTO etudiants (nom, prenom, date_nais, nationalite, serie, sexe, password, photo_passport) 
    VALUES (:nom, :prenom, :date_nais, :nationalite, :serie, :sexe, :password, :photo_passport)";

$stmt = $db->prepare($query);

// Binder les valeurs
$stmt->bindParam(':nom', $firstname);
$stmt->bindParam(':prenom', $lastname);
$stmt->bindParam(':date_nais', $birthday);
$stmt->bindParam(':nationalite', $country);
$stmt->bindParam(':serie', $serie);
$stmt->bindParam(':sexe', $sexe);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':photo_passport', $_FILES["image"]["name"]);

// Exécuter la requête
$stmt->execute();

        // Rediriger l'utilisateur vers une page de confirmation ou effectuer d'autres actions nécessaires
        header("Location: ../login.php");
        exit();
    } else {
        echo "Désolé, une erreur s'est produite lors du téléchargement du fichier.";
    }
}

?>