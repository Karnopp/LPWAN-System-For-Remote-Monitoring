#include <stdio.h>
#include <WiFi.h>
#include <WiFiClientSecure.h>
#include <PubSubClient.h>
#include "Arduino.h"
#include "heltec.h"
#define BAND 915E6
String conteudo_pacote;
long pacote;
char byte_recebido;
int cont_pacotes_recebidos=0;
#define DEBUG_UART_BAUDRATE        115200
/* Tópico MQTT para o qual o ESP32 enviará os dados */
#define MQTT_PUB_TOPIC "ESP32_pub"
/* Tópico MQTT do qual o ESP32 receberá dados */
#define MQTT_SUB_TOPIC "ESP32_callback"
#define MQTT_ID        "ESP32"
const char* ssid_wifi = "ssid_da_sua_rede_wifi";
const char* password_wifi = "senha_da_sua_rede_wifi";
WiFiClient espClient;
const char* broker_mqtt = "192.168.0.235";
int broker_port = 1883;
PubSubClient MQTT(espClient);
String C;
const char* ntpServer = "gps.ntp.br";
const long  gmtOffset_sec = -3600*4;
const int   daylightOffset_sec = 3600;
void init_wifi(void);
void init_MQTT(void);
void connect_MQTT(void);
void connect_wifi(void);
void verify_wifi_connection(void);
void mqtt_callback(char* topic, byte* payload, unsigned int length);
void connect_telegram();
void init_wifi(void){
  delay(10);
  connect_wifi();
}
void connect_wifi(void){
  if (WiFi.status() == WL_CONNECTED)
    return;
  WiFi.begin(ssid_wifi, password_wifi);
  while (WiFi.status() != WL_CONNECTED){
    delay(100);
  }
  Serial.println();
  Serial.print("Sucesso conexao wifi");
}
void verify_wifi_connection(void){
  connect_wifi();
}
void init_MQTT(void){
  MQTT.setServer(broker_mqtt, broker_port);
  MQTT.setCallback(mqtt_callback);
}
void connect_MQTT(void){
  while (!MQTT.connected())  {
    if (MQTT.connect(MQTT_ID)){
      Serial.println("Sucesso ao se conectar ao broker MQTT.");
      MQTT.subscribe(MQTT_SUB_TOPIC);
    }
    else{
    Serial.println("Falha ao se conectar ao broker MQTT.");
    Serial.println("Nova tentativa em 2s...");
    delay(2000);
    }
  }
}
void mqtt_callback(char* topic, byte* payload, unsigned int length){
  String msg_broker;
  char c;
  for(int i = 0; i < length; i++){
    c = (char)payload[i];
    msg_broker += c;
  }
}
String get_hora_data(){
  struct tm timeinfo;
  if(!getLocalTime(&timeinfo)){
    Serial.println("Failed to obtain time");
    return "";
  }
  char retorno[34];
  strftime(retorno,34, "/DATA/%Y-%m-%d/HORARIO/%H:%M:%S", &timeinfo);
  return retorno;
}
void setup(){
  configTime(gmtOffset_sec, daylightOffset_sec, ntpServer);
  Serial.begin(DEBUG_UART_BAUDRATE);
  init_wifi();
  init_MQTT();
  connect_MQTT();
  connect_telegram();
  Heltec.begin(true, true, false, true, BAND);
  Heltec.display->clear();
  Heltec.display->display();
  Heltec.display->screenRotate(ANGLE_0_DEGREE);
  Heltec.display->setContrast(25);
  Heltec.display->setFont(ArialMT_Plain_10);
  Heltec.display->drawString(0, 0, "INICIANDO");
  Heltec.display->display();
  delay(2000);
  Heltec.display->clear();
  Heltec.display->display();
  loop();
}
void loop(){
  char dados_mqtt[100] = {0};
  verify_wifi_connection();
  connect_MQTT();
  int packetSize = LoRa.parsePacket();
  if(packetSize) {
    conteudo_pacote="";
    while(LoRa.available ()) {
      conteudo_pacote += (char)LoRa.read();
    }
    String data_hora = get_hora_data();
    String payload_enviar=conteudo_pacote+data_hora;
    MQTT.publish(MQTT_PUB_TOPIC, payload_enviar.c_str(),1,true);//qos=1, retained = true
    cont_pacotes_recebidos++;
    Heltec.display->clear();
    Heltec.display->drawString(0, 0, conteudo_pacote);
    C=(String)cont_pacotes_recebidos;
    Heltec.display->drawString(0, 25,C);
    Heltec.display->display();
  }
  MQTT.loop();
}
