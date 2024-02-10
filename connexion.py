import mysql.connector
from mysql.connector import Error

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

except Error as e:
    print("Erreur lors de la connexion à MySQL", e)

finally:
    if connection.is_connected():
        cursor.close()
        connection.close()
        print("La connexion MySQL est fermée")
