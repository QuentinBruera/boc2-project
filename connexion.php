<?php
$servername = "localhost";
$username = "quentin";
$password = "nitneuq";
$dbname = "BLOC2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Erreur lors de la connexion à la BDD" . $conn->connect_error);
} else {
	echo "Connexion réussie";
}
?>
