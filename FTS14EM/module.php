<?
  class FTS14EM extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
	  $this->RegisterPropertyInteger("DeviceID", 0);
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
	
	}


	
	public function ApplyChanges()
	{
	  parent::ApplyChanges();
	
	  $this->SendDebug("FTS14",$this->GetConfigurationForParent(),0);
	}

	
	public function ReceiveData($JSONString) {
		// Empfangene Daten vom I/O
		echo "ok";

		$data = json_decode($JSONString);
		$this->LogMessage("ReceiveData aufgerufen", KL_DEBUG);
		IPS_LogMessage("FTS14EM-ReceiveData", utf8_decode($data->Buffer));
		SetValue($this->GetIDForIdent("Switch0"), true);
		$this->SendDebug("ReceiveData",utf8_decode($data->Buffer),0);
		

	}






  }
?>
