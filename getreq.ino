#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <Wire.h>
#include<Servo.h>
#include <LiquidCrystal_I2C.h> //This library you can add via Include Library > Manage Library > 
LiquidCrystal_I2C lcd(0x27, 16, 2);
Servo servo;
char* ssid = "Galaxy F22";
char* password = "password";
WiFiServer server(80);
//Your Domain name with URL path or IP address with path
String serverName = "http://rentmcproject.000webhostapp.com/form/display.php";
constexpr uint8_t RST_PIN = D1;     // Configurable, see typical pin layout above
constexpr uint8_t SS_PIN = D0;     // Configurable, see typical pin layout above

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
MFRC522::MIFARE_Key key;

String tag;

void setup() {
  Serial.begin(9600); 
  servo.attach(4);
  servo.write(0);
  Wire.begin(2,0); //sda,scl gpios
  lcd.begin();
   lcd.backlight(); // Enable or Turn On the backlight 
  SPI.begin(); // Init SPI bus
  rfid.PCD_Init(); // Init MFRC522
  WiFi.persistent( false );
  WiFi.begin(ssid, password);
  wifi_station_set_auto_connect(true);
  
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
    lcd.print("  Tap Your"); // Start Printing
    lcd.setCursor(2,1);
    lcd.print("    Card Here");
  delay(2000);
  if ( ! rfid.PICC_IsNewCardPresent())
    {
      Serial.println("notfound");
      return;
    }
  if (rfid.PICC_ReadCardSerial()) {
    Serial.println("found");
    lcd.clear();
    for (byte i = 0; i < 4; i++) {
      tag += rfid.uid.uidByte[i];
    }
    Serial.println(tag);
    if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;

      String serverPath = serverName + "?rfid=" +tag;
      
      // Your Domain name with URL path or IP address with path
      http.begin(serverPath.c_str());
      
      // Send HTTP GET request
      int httpResponseCode = http.GET();
      
      if (httpResponseCode>0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        //Serial.println(payload);
        int i=20;
        String res=""; 
        while(payload[i]!=';')
        { 
         // Serial.print(payload[i]);
          res=res+payload[i];
          i++;
        }
        Serial.println(res);
        i++;
        String user="";
         while(payload[i]!=';')
        { 
         // Serial.print(payload[i]);
          user=user+payload[i];
          i++;
        }
        Serial.println(user);
         int j=1;
          String bal="";
           while(j!=res.length())
            { 
             // Serial.print(payload[i]);
              bal=bal+res[j];
              j++;
            }
        if(res[0]=='w')
        {
           if(bal[0]=='-')
          {
            lcd.print("Low Bal:"+bal);
            lcd.setCursor(2,1);
            lcd.print("Pay :"+bal);
            delay(3000);
            lcd.clear();
            delay(2000);
              lcd.print("Tap Again");
              lcd.setCursor(2,1);
              lcd.print("After Recharge");
             delay(2000);
             lcd.clear();
             tag="";
             return;
          }
          else
          {
          lcd.print("Welcome "+user);
          lcd.setCursor(2,1);
          lcd.print("Balance:");
          lcd.print(bal);
          servo.write(90);
          } 
        }
        else
        {
          if(bal[0]=='-')
          {
            lcd.print("Low Bal:"+bal);
            lcd.setCursor(2,1);
            lcd.print("Pay :"+bal);
            delay(3000);
            lcd.clear();
            delay(2000);
            lcd.print("ThankYou "+user);
            lcd.setCursor(2,1);
            lcd.print("Balance:");
            lcd.print(bal);
            servo.write(90); 
        }
        delay(10000);
        servo.write(0); 
        lcd.clear();
      }
      else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
    tag = "";
    
    rfid.PICC_HaltA();
    rfid.PCD_StopCrypto1();
    delay(3000);
  }
}
