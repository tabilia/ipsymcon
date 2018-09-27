<?
  class FTS14EM extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
	  #$this->RequireParent("{018EF6B5-AB94-40C6-AA53-46943E824ACF}");	
	  $this->RegisterPropertyInteger("DeviceID", 0);
	  $this->RegisterPropertyInteger("PropertyInstanceID", 0);
	  
	  $this->RequireParent("{48909406-A2B9-4990-934F-28B9A80CD079}");

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


	  $this->ConnectParent("{48909406-A2B9-4990-934F-28B9A80CD079}");

	}


	
	public function ApplyChanges()
	{
	  parent::ApplyChanges();
	}

	
	public function ReceiveData($JSONString) {
		// Empfangene Daten vom I/O
		$data = json_decode($JSONString);
		IPS_LogMessage("FTS14EM-ReceiveData", utf8_decode($data->Buffer));
        }






  }
?>
