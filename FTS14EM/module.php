<?
  class FTS14EM extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
	  $this->RegisterPropertyInteger("EnOceanID", 0);
	}


	
	public function ApplyChanges()
	{
	  parent::ApplyChanges();
	}

	
	public function Update()
	{
	}

  }
?>
