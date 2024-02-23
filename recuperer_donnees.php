<?php
include 'connexion.php';

//$sql = "SELECT Temperature.Ville_ID, Temperature.Température_capteur, Temperature.Humidité_capteur, Temperature.Température_API, Temperature.Humidité_API, Temperature.Date FROM Temperature WHERE Temperature.Ville_ID=1 ORDER BY Temperature.Date DESC LIMIT 1;";
$sql2 = "SELECT Temperature.Ville_ID, Temperature.Température_capteur, Temperature.Humidité_capteur, Temperature.Température_API, Temperature.Humidité_API, Temperature.Date FROM Temperature WHERE Temperature.Ville_ID=1 ORDER BY Temperature.Date DESC;";
$result = $conn->query($sql2);

if ($result->num_rows > 0) {
	$rows = $result->fetch_all(MYSQLI_ASSOC);
}

function displaySmallCard($row) {
	for ($i = 1; $i < min(11, count($row)); $i++) {
		$date = htmlspecialchars($row[$i]['Date']);
		$temperatureCapteur = htmlspecialchars($row[$i]["Température_capteur"]);
		$humidityCapteur = htmlspecialchars($row[$i]["Humidité_capteur"]);
		$temperatureApi = htmlspecialchars($row[$i]["Température_API"]);
		$humidityApi = htmlspecialchars($row[$i]["Humidité_API"]);

        $cardHTML = <<<CARD
			<div class="smallCardContainer">
				<h3 class="smallCardDate">{$date}</h3>
				<div class="smallCardData">
					<img src="https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg" alt="" class="smallPicto"/>
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

/*
if ($result->num_rows > 0) {
    // Parcourir les lignes de résultat
    while($row = $result->fetch_assoc()) {
        //echo "Température_capteur: " . $row["Température_capteur"]. " - Température_API: " . $row["Température_API"]. " - Date: " . $row["Date"]. "<br>";
	$tempApi = $row["Température_API"];
	$humidityApi = $row["Humidité_API"];
        $tempCapteur = $row["Température_capteur"];
	$humidityCapteur = $row["Humidité_capteur"];
    }
} else {
    echo "0 résultats";
}
*/

$conn->close();
?>
