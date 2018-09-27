<?
  class FTS14EM extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
	  $this->RegisterPropertyInteger("DeviceID", 0);
	  	
      	  $this->RegisterVariableBoolean("Switch0","Switch0");
	}


	
	public function ApplyChanges()
	{
	  parent::ApplyChanges();
	}

	

  }
?>
