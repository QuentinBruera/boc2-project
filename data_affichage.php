<?php
// Import du fichier de connexion
include 'connexion.php';

// Vérifie si le formulaire a été soumis
if (isset($_GET['cityInput'])) {
    // Récupère la valeur de l'input
    $city = $_GET['cityInput'];
} else {
	$city = "Pau";
}

try {
	// Déclaration de la variable qui contient la requête SQL
	/*
	$sql = "SELECT Temperature.Ville_ID, Temperature.Température_capteur, Temperature.Humidité_capteur, Temperature.Température_API, Temperature.Humidité_API, Temperature.Date, Temperature.Picto FROM Temperature WHERE Temperature.Ville_ID=1 ORDER BY Temperature.Date DESC;";
	*/

	$sql = "SELECT * FROM Temperature INNER JOIN Ville ON Temperature.Ville_ID = Ville.ID WHERE Ville.NomVille LIKE '{$city}' ORDER BY Temperature.Date DESC LIMIT 10;";

	// On fait la requête et on stocke le résultat dans une variable
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$rows = $result->fetch_all(MYSQLI_ASSOC);
	}

	// Affiche les petites card tant qu'il y a de la data
	function displaySmallCard($row) {
		if (count($row) > 1) {
			for ($i = 1; $i < count($row); $i++) {
				$date = !empty($row[$i]["Date"]) ? htmlspecialchars($row[$i]["Date"]) : '';
				$temperatureCapteur = !empty($row[$i]["Température_Capteur"]) ? htmlspecialchars($row[$i]["Température_Capteur"]) : '--';
				$humidityCapteur = !empty($row[$i]["Humidité_Capteur"]) ? htmlspecialchars($row[$i]["Humidité_Capteur"]) : '--';
				$temperatureApi = !empty($row[$i]["Température_API"]) ? htmlspecialchars($row[$i]["Température_API"]) : '--';
				$humidityApi = !empty($row[$i]["Humidité_API"]) ? htmlspecialchars($row[$i]["Humidité_API"]) : '--';
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
	}

	function displaySmallCardPage2($row) {
		if (count($row) > 1) {
			for ($i = 1; $i <= count($row); ++$i) {
				$date = !empty($row[$i]["Date"]) ? htmlspecialchars($row[$i]["Date"]) : '';
				$temperatureCapteur = !empty($row[$i]["Température_Capteur"]) ? htmlspecialchars($row[$i]["Température_Capteur"]) : '--';
				$humidityCapteur = !empty($row[$i]["Humidité_Capteur"]) ? htmlspecialchars($row[$i]["Humidité_Capteur"]) : '--';
				$temperatureApi = !empty($row[$i]["Température_API"]) ? htmlspecialchars($row[$i]["Température_API"]) : '--';
				$humidityApi = !empty($row[$i]["Humidité_API"]) ? htmlspecialchars($row[$i]["Humidité_API"]) : '--';
				$picto = !empty($row[$i]["Picto"]) ? htmlspecialchars($row[$i]["Picto"]) : '';
				$cardHTML = <<<CARD
					<div class="history-card">
						<div class="weather-icon-small">
							<img src="{$picto}" alt="{$picto}" class="smallPicto"/>
						</div>
						<div class="temp-humidity">
							<p class="date">{$date}</p>
							<p>Extérieur: {$temperatureApi}°C, {$humidityApi}%</p>
							<p>Intérieur: {$temperatureCapteur}°C, {$humidityCapteur}%</p>
						</div>
					</div>
					CARD;
				echo $cardHTML;
			}
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
