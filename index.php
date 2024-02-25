<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <title>Document</title>
    </head> 
    <body>
	<?php include 'data_affichage.php'; ?>
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
                <h2 class="cardTitle"><?php echo $rows[0]["Date"]; ?></h2>
                <div class="cardContainer">
                    <div class="tempContainer cardElement">
                        <p class="tempOwm temp cardElement"><?php echo $rows[0]["Température_API"]; ?>°C</p>
                        <p class="humidityOwm temp cardElement"><?php echo $rows[0]["Humidité_API"]; ?>%</p>
                    </div>
                    <img
                        src="<?php echo $rows[0]["Picto"]; ?>"
                        alt="<?php echo $rows[0]["Picto"]; ?>"
                        class="picto"
                    />
                    <div class="humidityContainer cardElement">
                        <p class="tempSensor temp cardElement"><?php echo $rows[0]["Température_capteur"]; ?>°C</p>
                        <p class="humiditySensor humidity cardElement"><?php echo $rows[0]["Humidité_capteur"]; ?>%</p>
                    </div>
                </div>
            </div>
            <div class="smallCardSection">
                <?php displaySmallCard($rows); ?>
            </div>
        </section>
        <footer></footer>
    </body>
</html>
