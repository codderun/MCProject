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
  //pinMode(D2,OUTPUT);
  
    
}

void loop(){
if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;
      //string rfid = //scan
      String serverPath ="?rfid=200";
      //serverpath+=rfid;
      
      
      // Your Domain name with URL path or IP address with path
      http.begin(serverPath);
      
      // Send HTTP GET request
      int httpResponseCode = http.GET();
      
      if (httpResponseCode>0) {
        Serial.print("http Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        //Serial.println(payload);
        
        for(int i=20; i<30; i++){
          Serial.print(payload[i]);
        }
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

  delay(5000);
}
