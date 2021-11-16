#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
char* ssid = ""; // put ssid
char* password = ""; // put password
WiFiServer server(80);

String serverName = "http://rentmcproject.000webhostapp.com/form/display.php";

void setup() {
  Serial.begin(9600);
  Serial.println("Connecting to WiFi");
  WiFi.begin(ssid,password);
  while(WiFi.status()!=WL_CONNECTED){
        Serial.print(".");
        delay(500);
    }
  Serial.println("WiFi Connected");
  server.begin();
  Serial.println(WiFi.localIP());
}

void loop(){
if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;
      string rfid =""
      String serverPath = serverName+ "?rfid=" + rfid;
      http.begin(serverPath);
      int httpResponseCode = http.GET(); // // Send HTTP GET request
      
      if (httpResponseCode>0) {
        Serial.print("http Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        for(int i=20; i<30; i++){ //get only required
          Serial.print(payload[i]);
        }
      }
      else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
  delay(5000);
}
