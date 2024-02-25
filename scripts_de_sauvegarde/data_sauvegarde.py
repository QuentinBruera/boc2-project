import os
import mysql.connector
from mysql.connector import Error
import bme280
import requests
from datetime import date
from dotenv import load_dotenv

#Chargement des variables d'environnement du fichier .env
load_dotenv()

#Récuperation de la DATA du capteur
temperature,pressure,humidity = bme280.readBME280All()

#Récuperation depuis l'api OWM
def obtenir_temperature(ville, pays, api_key):
     url= f"https://api.openweathermap.org/data/2.5/weather?q={ville},FR&appid={api_key}&units=metric"
     reponse = requests.get(url)
     if reponse.status_code == 200:
        donnees_meteo = reponse.json()
        results = [
            donnees_meteo['main']['temp'], 
            donnees_meteo['main']['humidity'], 
            donnees_meteo['dt'], 
            donnees_meteo['weather'][0]['icon']
        ]
        return results
     else:
        return "Erreur dans la requête"

api_key = os.getenv('API_KEY')
ville = 'Pau'
pays = 'FR'
results = obtenir_temperature(ville, pays, api_key)

timestamp =(results[2])
date = date.fromtimestamp(timestamp)
formatted_date = date.strftime('%Y-%m-%d')

#Information de connexion à la base de données
connection = mysql.connector.connect(
        host=os.getenv('HOST'),
        database=os.getenv('DATABASE'),
        user=os.getenv('USER'),
        password=os.getenv('PASSWORD'),
)
try:
    if connection.is_connected():
        db_Info = connection.get_server_info()
        print("Connecté à MySQL Server version ", db_Info)
        cursor = connection.cursor()
        cursor.execute("select database();")
        record = cursor.fetchone()
        print("Vous êtes connecté à la base de données: ", record)
        cursor.execute(f"INSERT INTO `Temperature`(`Ville_ID`, `Date`, `Température_Capteur`, `Picto`, `Humidité_Capteur`, `Température_API`, `Humidité_API`) VALUES  ('1', '{formatted_date}', {temperature}, 'http://openweathermap.org/img/w/{results[3]}.png', {humidity}, {results[0]}, {results[1]})")
        connection.commit()
except Error as e:
    print("Erreur lors de la connexion à MySQL", e)
finally:
    if connection.is_connected():
        cursor.close()
        connection.close()
        print("La connexion MySQL est fermée")