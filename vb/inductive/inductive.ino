void setup() {
  Serial.begin(9600);
}

void loop() {
  int sensorValue = analogRead(A0);
  int sensorValue1 = analogRead(A1);
  int sensorValue2 = analogRead(A2);

delay(10);

  if (sensorValue>0)  {Serial.print("0"); }  else{Serial.print("1"); }
  if (sensorValue1>0) {Serial.print("0"); }  else{Serial.print("1"); }
  if (sensorValue2>0) {Serial.println("0");} else{Serial.println("1"); }
  delay(500);        
}
