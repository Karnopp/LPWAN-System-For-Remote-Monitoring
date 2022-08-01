#include "heltec.h"
#define BAND 915E6
#define INTERVAL 5000
int contador=0;
long lastSendTime = 0;
int cont_pacotes_enviados=0;
void send() {
  if(digitalRead(17)==0){
    cont_pacotes_enviados++;
    String C=(String)cont_pacotes_enviados;
    Heltec.display->drawString(0, 0, "NIVEL BAIXO");
    Heltec.display->drawString(0, 25, C);
    Heltec.display->display();
    Heltec.display->clear();
    LoRa.beginPacket();
    LoRa.print("NIVEL/BAIXO");
    LoRa.endPacket();
  }
  else{
    cont_pacotes_enviados++;
    String C=(String)cont_pacotes_enviados;
    Heltec.display->drawString(0, 0, "NIVEL ALTO");
    Heltec.display->drawString(0, 25, C);
    Heltec.display->display();
    Heltec.display->clear();
    LoRa.beginPacket();
    LoRa.print("NIVEL/ALTO");
    LoRa.endPacket();
  }
}
void setup () {
  Heltec.begin(true, true, true, true, BAND);
  pinMode(17, INPUT);
  Heltec.display->clear();
  Heltec.display->display();
  Heltec.display->screenRotate(ANGLE_180_DEGREE);
  Heltec.display->setFont(ArialMT_Plain_24);
  Heltec.display->setContrast(25);
  Heltec.display->clear();
}
void loop () {

  if (millis() - lastSendTime > INTERVAL){
    lastSendTime = millis();
  send();
  }
}
