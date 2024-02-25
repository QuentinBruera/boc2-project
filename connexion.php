<?php
// Importation du fichier .env
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Déclaratgion de mes variables pour la connexion à la BDD
$servername = $_ENV['HOST'];
$username = $_ENV['USER'];
$password = $_ENV['PASSWORD'];
$dbname = $_ENV['DATABASE'];

// Active les exceptions pour les erreurs mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    die("Erreur lors de la connexion à la BDD: " . $e->getMessage());
}
?>