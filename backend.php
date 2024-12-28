<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Backend</title>
</head>
<body>
    <?php
    // Configuration de la base de données
    $host = 'localhost';
    $user = 'root'; // Remplacez par votre nom d'utilisateur
    $password = 'Razak@1234'; // Remplacez par votre mot de passe
    $database = 'deneme';
    $port = 3306; // Nouveau port MySQL

    // Connexion à la base de données
    $conn = new mysqli($host, $user, $password, $database, $port);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];

        // Sécuriser le mot de passe en le hachant
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Préparer la requête SQL pour insérer les données dans la base de données
        $sql = "INSERT INTO candidats (nom, email, mot_de_passe) VALUES (?, ?, ?)";

        // Préparer la requête
        if ($stmt = $conn->prepare($sql)) {
            // Lier les paramètres
            $stmt->bind_param("sss", $nom, $email, $mot_de_passe_hash);

            // Exécuter la requête
            if ($stmt->execute()) {
                echo "<p>Inscription réussie!</p>";
            } else {
                echo "<p>Erreur lors de l'inscription : " . $stmt->error . "</p>";
            }

            // Fermer la déclaration préparée
            $stmt->close();
        }
    }

    // Fermer la connexion
    $conn->close();
    ?>
</body>
</html>
