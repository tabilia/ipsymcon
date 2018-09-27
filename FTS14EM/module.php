<?
  class FTS14EM extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
	  $this->RegisterPropertyInteger("UpperRotarySwitch", 0);
	  $this->RegisterPropertyInteger("LowerRotarySwitch", 1);
	  $this->RegisterPropertyInteger("SwitchType", 0);
	  $this->RegisterPropertyInteger("PropertyInstanceID", 0);
	  

      	  $this->RegisterVariableBoolean("Switch0","Switch0");
      	  $this->RegisterVariableBoolean("Switch1","Switch1");
      	  $this->RegisterVariableBoolean("Switch2","Switch2");
      	  $this->RegisterVariableBoolean("Switch3","Switch3");
      	  $this->RegisterVariableBoolean("Switch4","Switch4");
      	  $this->RegisterVariableBoolean("Switch5","Switch5");
      	  $this->RegisterVariableBoolean("Switch6","Switch6");
      	  $this->RegisterVariableBoolean("Switch7","Switch7");
	  $this->RegisterVariableBoolean("Switch8","Switch8");
	  $this->RegisterVariableBoolean("Switch9","Switch9");


	
	  $this->ConnectParent("{AC6C6E74-C797-40B3-BA82-F135D941D1A2}");
//	  $this->ConnectParent("{A52FEFE9-7858-4B8E-A96E-26E15CB944F7}");

	}


	
	public function ApplyChanges()
	{
	  parent::ApplyChanges();
#	  $this->SetReceiveDataFilter(".*");	
#	  $this->ConnectParent("{AC6C6E74-C797-40B3-BA82-F135D941D1A2}");
#	  $this->SendDebug("FTS14","applychanges".$this->GetConfigurationForParent(),0);
	}



	
	public function ReceiveData($JSONString) {
		// Empfangene Daten vom I/O

		$data = json_decode($JSONString);
		//$this->SendDebug("FTS14EM RD","ReceiveData aufgerufen", 0);
		#IPS_LogMessage("FTS14EM-RD", utf8_decode($data->Buffer));
		$this->SendDebug("ReceiveData",utf8_decode($data->Buffer),0);


		$data=utf8_decode($data->Buffer);

	

		$myaddr=1000 + $this->ReadPropertyInteger("UpperRotarySwitch") + $this->ReadPropertyInteger("LowerRotarySwitch");  
		$this->sendDebug("MyADDR",$myaddr,0);
		

		if (substr($data,0,4)=="\xA5\x5A\x0B\x05") {
			// TODO prüfen ob für mich

			$this->sendDebug("RD-ADDR",substr($data,8,4),0);

			$this->SendDebug("RD-Start","0xA55A",0);
			switch (substr($data,4,1)) {

			case "\x00":
				break;
				$this->sendDebug("RD SW","0",0);
			case "\x10":
				$this->sendDebug("RD SW","10",0);
				break;
			case "\x30":
				$this->sendDebug("RD SW","30",0);
				break;
			case "\x50":
				$this->sendDebug("RD SW","50",0);
				break;
			case "\x70":
				$this->sendDebug("RD SW","70",0);
				break;
			}
		}
	}






  }

/* Beispieltelegram:
 *
 * A5 5A 0B 05  00 	00 	00 	00 	00 	00 	10 	01 	20 41 
 * x  x  x  ORG byte3   byte2	byte1	byte0	send3	send2	send1	send0	
 *
 *
FTS14EM (nur Telegramme für den Eltako-RS485-Bus)
Je nach eingestelltem ID- Bereich (Addition aus unterem Drehschalter +
oberem Drehschalter + 1000) ergeben sich folgende Basis- ID´s.
Beispiel für Gruppe 1: 1 (unterer Drehschalter) +0 (oberer Drehschalter)
+1000 = Basis- ID = 1001
Beispiel für Gruppe 1: 1 (unterer Drehschalter) +90 (oberer Drehschalter)
+1000 = Basis- ID = 1091
Beispiel für Gruppe 5: 401 (unterer Drehschalter) +30 (oberer Drehschalter)
+1000 = Basis- ID = 1431
ORG = 0x05
Einstellung UT
Data_byte3 = Ansteuerung von +E1 -> 0x70 (Basis-ID +0)
 Ansteuerung von +E2 -> 0x50 (Basis-ID +1)
 Ansteuerung von +E3 -> 0x30 (Basis-ID +2)
 Ansteuerung von +E4 -> 0x10 (Basis-ID +3)
 Ansteuerung von +E5 -> 0x70 (Basis-ID +4)
 Ansteuerung von +E6 -> 0x50 (Basis-ID +5)
 Ansteuerung von +E7 -> 0x30 (Basis-ID +6)
 Ansteuerung von +E8 -> 0x10 (Basis-ID +7)
 Ansteuerung von +E9 -> 0x70 (Basis-ID +8)
 Ansteuerung von +E10 -> 0x50 (Basis-ID +9)
Bei der Einstellung RT werden automatisch Paare mit geraden ID´s gebildet:
+E1/+E2, +E3/+E4, +E5/+E6, +E7/+E8, +E9/+E10
Wird die Ansteuerung eines Steuereingangs beendet,
wird ein Telegramm mit der jeweiligen ID und Data_byte3 = 0x00 erzeugt.
Data_byte2 = not used (0x00)
Data_byte1 = not used (0x00)
Data_byte0 = not used (0x00)
 */
?>
