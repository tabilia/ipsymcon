<?
  class FTS14EM extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
	  $this->RegisterPropertyInteger("DeviceID", 0);
	  	
   	  $this->RequireParent("{52FEFE9-7858-4B8E-A96E-26E15CB944F7}");

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
	}


	
	public function ApplyChanges()
	{
	  parent::ApplyChanges();
	}

	

  }
?>
