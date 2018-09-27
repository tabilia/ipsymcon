<?
  class DimmerNightControl extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
#	  $this->RegisterPropertyInteger("UpperRotarySwitch", 0);
#	  $this->RegisterPropertyInteger("LowerRotarySwitch", 0);
#	  $this->RegisterPropertyInteger("SwitchType", 0);
#	  $this->RegisterPropertyInteger("PropertyInstanceID", 0);
	  

#      	  $this->RegisterVariableBoolean("Switch0","Switch0");

	}


	
	public function ApplyChanges()
	{
		parent::ApplyChanges();
	}

  }
	
