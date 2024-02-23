import os
import mysql.connector
from datetime import datetime

from dotenv import load_dotenv

# Chargement des variables d'environnement du fichier .env
load_dotenv()

# Nom de la table à sauvegarder
table_name = os.getenv('TABLE_NAME')

# Chemin du dossier de sauvegarde
backup_folder = os.getenv('BACKUP_FOLDER')

# Paramètres de connexion à la base de données
db_config = {
    'user': os.getenv('USER'),
    'password': os.getenv('PASSWORD'),
    'host': os.getenv('HOST'),
    'database': os.getenv('DATABASE'),
}

# Connexion à la base de données
conn = mysql.connector.connect(**db_config)
cursor = conn.cursor()

# Nom du fichier de sauvegarde avec la date et l'heure
backup_filename = f"{backup_folder}/{table_name}_backup_{datetime.now().strftime('%Y-%m-%d_%H-%M-%S')}.sql"

# Commande pour la sauvegarde
dump_command = f"mysqldump -u {db_config['user']} -p{db_config['password']} {db_config['database']} {table_name} >{backup_filename}"

# Exécution de la commande de sauvegarde
os.system(dump_command)

# Vérification du nombre de sauvegardes dans le dossier
backups = sorted([file for file in os.listdir(backup_folder) if file.endswith('.sql')])

"""
files = os.listdir(backup_folder)
backups = []
for file in files:
    if file.endswith('.sql'):
        backups.append(file)
"""

# Suppression du plus ancien si plus de trois sauvegardes
if len(backups) > 3:
    os.remove(os.path.join(backup_folder, backups[0]))

# Fermeture de la connexion à la base de données
cursor.close()
conn.close()