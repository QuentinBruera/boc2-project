import mysql.connector
from mysql.connector import Error
import bme280
import requests
from datetime import date

#Récuperation de la DATA du capteur
temperature,pressure,humidity = bme280.readBME280All()

#Récuperation depuis l'api OWM
def obtenir_temperature(ville, pays, api_key):
     url= f"https://api.openweathermap.org/data/2.5/weather?q=Pau,FR&appid=9a8209372f8443026c5ab07c38856708&units=metric"
     print(url)
     reponse = requests.get(url)
     if reponse.status_code == 200:
        donnees_meteo = reponse.json()
        results = [donnees_meteo['main']['temp'],donnees_meteo['main']['humidity'],donnees_meteo['dt']]
        return results
     else:
        return "Erreur dans la requête"

api_key = '9a8209372f8443026c5ab07c38856708'
ville = 'Pau'
pays = 'FR'
results = obtenir_temperature(ville, pays, api_key)
timestamp =(results[2])
date = date.fromtimestamp(timestamp)
formatted_date = date.strftime('%Y-%m-%d')

#Information de connexion à la base de données
connection = mysql.connector.connect(
        host='localhost',
        database='BLOC2',
        user='quentin',
        password='nitneuq')

try:

    if connection.is_connected():
        db_Info = connection.get_server_info()
        print("Connecté à MySQL Server version ", db_Info)
        cursor = connection.cursor()
        cursor.execute("select database();")
        record = cursor.fetchone()
        print("Vous êtes connecté à la base de données: ", record)
        cursor.execute(f"INSERT INTO `Temperature`(`Ville_ID`, `Date`, `Température_Capteur`, `Picto`, `Humidité_Capteur`, `Température_API`, `Humidité_API`) VALUES  ('1', '{formatted_date}', {temperature}, 'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg', {humidity}, {results[0]}, {results[1]})")
        connection.commit()
except Error as e:
    print("Erreur lors de la connexion à MySQL", e)
    if connection.is_connected():
        cursor.close()
        connection.close()
        print("La connexion MySQL est fermée")

print ("temperature capteur : ", temperature)
print ("humidite capteur : ",humidity)
print ("temperature API : ",results[0])
print ("humidte API : ",results[1])
print ("date: ",formatted_date)