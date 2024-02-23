import os
import mysql.connector
from dotenv import load_dotenv

# Chargement des variables d'environnement du fichier .env
load_dotenv()

# Paramètres de connexion à la base de données
db_config = {
    'user': os.getenv('USER'),
    'password': os.getenv('PASSWORD'),
    'host': os.getenv('HOST'),
}

# Base de données à restaurer
database_name = os.getenv('DATABASE')

# Fichier de sauvegarde à restaurer (le plus récent)
backup_folder = os.getenv('BACKUP_FOLDER')
backups = sorted([file for file in os.listdir(backup_folder) if file.endswith('.sql')], reverse=True)
backup_file = os.path.join(backup_folder, backups[0]) if backups else None

if backup_file:
    # Fait la connexion à la base de données
    try:
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor()
        
        # Supprime l'ancienne base de données
        cursor.execute(f"DROP DATABASE IF EXISTS {database_name}")
        conn.commit()
        
        # Créer une nouvelle base de données
        cursor.execute(f"CREATE DATABASE {database_name}")
        conn.commit()
        
        # Restaure la base de données à partir du fichier de sauvegarde le plus récent
        restore_command = f"mysql -u {db_config['user']} -p{db_config['password']} {database_name} < {backup_file}"
        os.system(restore_command)
        
        print(f"La base de données {database_name} a été restaurée avec succès à partir de {backup_file}.")
        
    except mysql.connector.Error as e:
        print(f"Erreur lors de la restauration de la base de données: {e}")
    finally:
        # Ferme la connexion à la base de données
        if conn.is_connected():
            cursor.close()
            conn.close()
else:
    print("Aucun fichier de sauvegarde trouvé pour la restauration.")

