import os
import mysql.connector
from datetime import datetime
from dotenv import load_dotenv

# Chargement des variables d'environnement du fichier .env
load_dotenv()

# Chemin du dossier de sauvegarde
backup_folder = os.getenv('BACKUP_FOLDER')

# Paramètres de connexion à la base de données
db_config = {
    'user': os.getenv('USER'),
    'password': os.getenv('PASSWORD'),
    'host': os.getenv('HOST'),
    'database': os.getenv('DATABASE'),
}

try:
    # Connexion à la base de données
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor()

    # Nom du fichier de sauvegarde avec la date et l'heure
    backup_filename = f"{backup_folder}/{db_config['database']}_backup_{datetime.now().strftime('%Y-%m-%d_%H-%M-%S')}.sql"

    # Commande pour la sauvegarde de toute la base de données
    dump_command = f"mysqldump -u {db_config['user']} -p{db_config['password']} {db_config['database']} > {backup_filename}"

    # Exécution de la commande de sauvegarde
    os.system(dump_command)

    # Vérification du nombre de sauvegardes dans le dossier
    backups = sorted([file for file in os.listdir(backup_folder) if file.endswith('.sql')])

    # Suppression du plus ancien si plus de trois sauvegardes
    if len(backups) > 3:
        os.remove(os.path.join(backup_folder, backups[0]))
except mysql.connector.Error as error:
    print(f"Erreur de connexion à la base de données : {error}")
finally:
    # Ferme la connexion à la base de données
    if conn.is_connected():
        cursor.close()
        conn.close()