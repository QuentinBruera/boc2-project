import bme280
import requests
import os
from dotenv import load_dotenv

# Chargement des variables d'environnement du fichier .env
load_dotenv()

temperature,pressure,humidity = bme280.readBME280All()

def obtenir_temperature(ville, pays, api_key):
    url = f"http://api.openweathermap.org/data/2.5/weather?q={ville},{pays}&appid={api_key}&units=metric"
    print(url)
    reponse = requests.get(url)
    if reponse.status_code == 200:
        donnees_meteo = reponse.json()
        temperature_api = donnees_meteo['main']['temp']
        humidity_api = donnees_meteo['main']['humidity']
        results = [temperature_api, humidity_api]
        return results
    else:
        return "Erreur dans la requête"

api_key = os.getenv('API_KEY')
ville = 'Pau'
pays = 'FR'
results = obtenir_temperature(ville, pays, api_key)
print(f"La température à {ville} est de {results[0]}°C et l'humidité est de {results[1]}%")

print ("Temperature : ", temperature, "C")
print ("Pressure : ", pressure, "hPa")
print ("Humidity : ", humidity, "%")
