from scripts_de_sauvegarde import bme280
from RPLCD.i2c import CharLCD

# Variable qui stocke la méthode qui nous sert à "parter" avec l'écran LCD
lcd = CharLCD('PCF8574', 0x27)

# Récupération des données du catpeur dans une variable
temperature,pressure,humidity = bme280.readBME280All()

# Instruction pour l'affichage de l'écran LCD
lcd.write_string('Salut à tous !')
lcd.cursor_pos = (1, 0)
lcd.write_string('Il fait : ' + str(temperature) + 'C !')

# Affiche dans la console les données
print ("Temperature : ", temperature, "C")
print ("Pressure : ", pressure, "hPa")
print ("Humidity : ", humidity, "%")
