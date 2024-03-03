<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Température et Humidité Intérieure/Extérieure</title>
        <link rel="stylesheet" href="style2.css" />
    </head>
    <body>
    <?php include 'data_affichage.php'; ?>
        <div class="city-banner">
            <h1 id="cityName"><?= $rows[0]["NomVille"]; ?></h1>
            <img
                src="./city_skyline.png"
                alt="Skyline de la Ville"
                class="city-image"
            />
        </div>
        <div class="weather-container">
            <div class="search-container">
                <form action="#" method="get" class="search-container">
                    <input type="text" name="cityInput" id="cityInput" placeholder="Recherchez une ville..." class="search-input" />
                </form>
                <input type="date" id="dateInput" class="date-input" />
            </div>
            <div class="main-card">
                <div class="weather-icon">
                <img
                        src="<?= $rows[0]["Picto"]; ?>"
                        alt="<?= $rows[0]["Picto"]; ?>"
                        class="picto"
                    />
                </div>
                <div class="temperature">Extérieur: <?= $rows[0]["Température_API"]; ?>°C</div>
                <div class="humidity">Humidité: <?= $rows[0]["Humidité_API"]; ?>%</div>
                <div class="interior">
                    <p>Intérieur: <?= $rows[0]["Température_Capteur"]; ?>°C, <?= $rows[0]["Humidité_Capteur"]; ?>%</p>
                </div>
            </div>
            <div class="history">
                <h2>Historique</h2>
                <?php displaySmallCardPage2($rows); ?>
            </div>
        </div>
        <footer class="footer">
            <p>Ce site est créé par la team Quentin. Tous droits réservés.</p>
        </footer>
    </body>
</html>
