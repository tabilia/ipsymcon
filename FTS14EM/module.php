<?
  class FTS14EM extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
	  $this->RegisterPropertyInteger("DeviceID", 0);
	  	
      	# $this->RegisterPropertyBoolean("Switch0", false);
	}


	
	public function ApplyChanges()
	{
	  parent::ApplyChanges();
	}

	

  }
?>
