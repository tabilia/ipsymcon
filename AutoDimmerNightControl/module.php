<?
  class AutoDimmerNightControl extends IPSModule
  {
	public function Create()
	{
	  parent::Create();
	  // erzeugt benötigte variablen etc.
#	  $this->RegisterPropertyInteger("LowerRotarySwitch", 0);
#	  $this->RegisterPropertyInteger("SwitchType", 0);
#	  $this->RegisterPropertyInteger("PropertyInstanceID", 0);
	  
	  $this->RegisterPropertyInteger("MotionDetectorID", 0);
	  $this->RegisterPropertyInteger("SwitchID", 0);
	  $this->RegisterPropertyInteger("DimmerID", 0);
	  $this->RegisterPropertyInteger("DayStartTime", 0);
	  $this->RegisterPropertyInteger("DimmerValueDay", 0);
	  $this->RegisterPropertyInteger("NightStartTime", 0);
	  $this->RegisterPropertyInteger("DimmerValueNight", 0);

	 # $this->RegisterPropertyInteger("", 0);
	 # $this->RegisterPropertyInteger("", 0);
	}


	
	public function ApplyChanges()
	{
		parent::ApplyChanges();
	}


	public function MotionDetectorEnableLight()
	{
		$DimmerID=$this->ReadPropertyInteger("DimmerID");
		$value=50;
		ENO_DimSet($DimmerID, 20);
		#	SetValue($DimmerID, $value); 
	}
	public function SwitchEnableLight()
	{
		$DimmerID=$this->ReadPropertyInteger("DimmerID");
		$value=100;
		ENO_DimSet($DimmerID, 100);
	#	SetValue($DimmerID, $value); 
	}
		
	
  }
	
