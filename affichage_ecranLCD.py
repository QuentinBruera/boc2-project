import bme280
from RPLCD.i2c import CharLCD

lcd = CharLCD('PCF8574', 0x27)

#lcd.write_string('Hello world', temperature)

temperature,pressure,humidity = bme280.readBME280All()

lcd.write_string('Salut à tous !')
lcd.cursor_pos = (1, 0)
lcd.write_string('Il fait : ' + str(temperature) + 'C !')

print ("Temperature : ", temperature, "C")
print ("Pressure : ", pressure, "hPa")
print ("Humidity : ", humidity, "%")
