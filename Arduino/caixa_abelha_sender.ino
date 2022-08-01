#include <HX711_ADC.h>
#include "heltec.h"
#define DT_PIN 17
#define SCK_PIN 22
#define BAND 915E6

float offset_tara = 8491134;
float fator_calibracao = -20.92;
const int Interval = 5000;
int cont_pacotes_enviados=0;

HX711_ADC Load_Cells(DT_PIN, SCK_PIN);
unsigned long t = 0;
void setup() {
  Serial.begin(115200);
  Heltec.begin(true, true, false, true, BAND);
  Heltec.display->clear();
  Heltec.display->display();
  Heltec.display->screenRotate(ANGLE_180_DEGREE);
  Heltec.display->setContrast(25);
  Heltec.display->setFont(ArialMT_Plain_10);
  Heltec.display->drawString(0, 0, "INICIANDO");
  Heltec.display->display();
  delay(1000);
  Load_Cells.begin();//inicializa celulas
  Load_Cells.setCalFactor(fator_calibracao);
  Load_Cells.setTareOffset(offset_tara);//calcula tara
  Load_Cells.refreshDataSet();
}
void loop(){

  if (millis() - t > Interval) {
    send();
  }
}

void send(){
  Load_Cells.refreshDataSet();
  float soma=0;
  for(int i=0;i<10000;i++){
    Load_Cells.update();
    soma += Load_Cells.getData();
  }
  soma /= 10000;
  t=millis();
  cont_pacotes_enviados++;
  String C=(String)cont_pacotes_enviados;
  Heltec.display->clear();
  Heltec.display->drawString(0, 0, "Peso: ");
  Heltec.display->drawString(0, 20, (String)soma + " gr");
  Heltec.display->drawString(0, 40, C);
  Heltec.display->display();
  LoRa.beginPacket();
  LoRa.print("PESO/"+(String)soma);
  LoRa.endPacket();
}
