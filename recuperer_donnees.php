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
		$temperatureCapteur = htmlspecialchars($row[$i]["Temperature_capteur"]);
		$humidityCapteur = htmlspecialchars($row[$i]["Humidite_capteur"]);
		$temperatureApi = htmlspecialchars($row[$i]["Temperature_API"]);
		$humidityApi = htmlspecialchars($row[$i]["Humidite_API"]);

		echo '<div class="smallCardContainer">';
		echo '<h3 class="smallCardDate">789</h3>';
		echo '<div class="smallCardData">';
		echo '<img src="https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg" alt="" class="smallPicto"/>';
		echo '<div class="smallCardDataOWM">';
		echo '</div>';
		echo '</div>';
		echo '</div>';
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
