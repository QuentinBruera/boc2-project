<?php
// Import du fichier de connexion
include 'connexion.php';

try {
	// Déclaration de la variable qui contient la requête SQL
	$sql = "SELECT Temperature.Ville_ID, Temperature.Température_capteur, Temperature.Humidité_capteur, Temperature.Température_API, Temperature.Humidité_API, Temperature.Date, Temperature.Picto FROM Temperature WHERE Temperature.Ville_ID=1 ORDER BY Temperature.Date DESC;";

	// On fait la requête et on stocke le résultat dans une variable
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$rows = $result->fetch_all(MYSQLI_ASSOC);
	}

	// Affiche les petites card tant qu'il y a de la data
	function displaySmallCard($row) {
		for ($i = 1; $i < min(11, count($row)); $i++) {
			$date = !empty($row[$i]["Date"]) ? htmlspecialchars($row[$i]["Date"]) : '';
			$temperatureCapteur = !empty($row[$i]["Température_capteur"]) ? htmlspecialchars($row[$i]["Température_capteur"]) : 'NULL';
			$humidityCapteur = !empty($row[$i]["Humidité_capteur"]) ? htmlspecialchars($row[$i]["Humidité_capteur"]) : 'NULL';
			$temperatureApi = !empty($row[$i]["Température_API"]) ? htmlspecialchars($row[$i]["Température_API"]) : 'NULL';
			$humidityApi = !empty($row[$i]["Humidité_API"]) ? htmlspecialchars($row[$i]["Humidité_API"]) : 'NULL';
			$picto = !empty($row[$i]["Picto"]) ? htmlspecialchars($row[$i]["Picto"]) : '';

			$cardHTML = <<<CARD
				<div class="smallCardContainer">
					<h3 class="smallCardDate">{$date}</h3>
					<div class="smallCardData">
						<img src="{$picto}" alt="{$picto}" class="smallPicto"/>
						<div class="smallCardDataOWM">
							<p class="smallCardDataOWMText">OWM</p>
							<p class="smallCardDataOWMTemp">{$temperatureApi}°C</p>
							<p class="smallCardDataOWMHumidity">{$humidityApi}%</p>
						</div>
						<div class="smallCardDataSensor">
							<p class="smallCardDataSensorText">Capteur</p>
							<p class="smallCardDataSensorTemp">{$temperatureCapteur}°C</p>
							<p class="smallCardDataSensorHumidity">{$humidityCapteur}%</p>
						</div>
					</div>
				</div>
				CARD;
			echo $cardHTML;
		}
	}
} catch (mysqli_sql_exception $e) {
	echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
} finally {
	// Ferme la connexion à la BDD
	if ($conn) {
        $conn->close();
    }
}
?>
