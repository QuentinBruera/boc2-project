<?php
$servername = "localhost";
$username = "quentin";
$password = "nitneuq";
$dbname = "BLOC2";

// Active les exceptions pour les erreurs mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    echo "Connexion réussie";
} catch (mysqli_sql_exception $e) {
    die("Erreur lors de la connexion à la BDD: " . $e->getMessage());
}
?>