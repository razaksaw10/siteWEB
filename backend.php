<?php
// Configuration de la base de données
$host = 'localhost';
$user = '#'; // Remplacez par votre nom d'utilisateur
$password = '#'; // Remplacez par votre mot de passe
$database = 'deneme';
$port = 3307; // Nouveau port MySQL

// Connexion à la base de données
$conn = new mysqli($host, $user, $password, $database, $port);

// Vérification de la connexion
if ($conn->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Échec de la connexion : ' . $conn->connect_error
    ]));
}

// Requête SQL pour récupérer les données
$sql = "SELECT id, nom FROM candidats";
$result = $conn->query($sql);

// Vérification et traitement des résultats
$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    // Si aucune donnée n'est trouvée, renvoyer un tableau vide
    $data = [];
}

// Envoi des données au format JSON
header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'data' => $data
]);

// Fermeture de la connexion
$conn->close();
?>
