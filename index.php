<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <title>Document</title>
    </head>
    <body>
	<?php include 'recuperer_donnees.php'; ?>
        <head></head>
        <section>
            <div>
                <div class="bannerContainer">
                    <div class="bannerInfo">
                        <h2 class="cityName">PAU <?php echo $test;?></h2>
                        <p class="cityInfo">
                            64000 - Pyrénées-Atlantique - France
                        </p>
                    </div>
                    <img
                        src="https://static1.mclcm.net/iod/images/v2/69/citytheque/localite_101_324/800x360_100_300_000000x10x0.jpg"
                        alt=""
                        class="bannerImg"
                    />
                </div>
            </div>
            <div class="cardSection">
		<h2 class="cardTitle">Dernier relevé météo pour la ville de Pau</h2>
                <div class="cardContainer">
                    <div class="tempContainer cardElement">
                        <p class="tempOwm temp cardElement"><?php echo $rows[0]["Température_API"]; ?>°C</p>
                        <p class="humidityOwm temp cardElement"><?php echo $rows[0]["Humidité_API"]; ?>%</p>
                    </div>
                    <img
                        src="https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg"
                        alt=""
                        class="picto"
                    />
                    <div class="humidityContainer cardElement">
                        <p class="tempSensor temp cardElement"><?php echo $tempCapteur; ?>°C</p>
                        <p class="humiditySensor humidity cardElement"><?php echo $humidityCapteur; ?>%</p>
                    </div>
                </div>
            </div>
            <div>
                <?php displaySmallCard($rows); ?>
            </div>
            <form>
                <label for="date">Choisissez une date:</label>
                <input type="date" id="date" name="date" />
            </form>
        </section>
        <footer></footer>
    </body>
    <script src="index.js"></script>
</html>
