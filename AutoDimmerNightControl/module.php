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

	  $this->RegisterTimer("OffTimer", 0, "DNC_Stop(1);");
	}

	public function Stop($a) {
		$this->SetTimerInterval("OffTimer", 0);
	  	$DimmerID=$this->ReadPropertyInteger("DimmerID");
		ENO_DimSet($DimmerID,0);
		$this->SendDebug("Stop","Dimmer aus!",0);
	}
	
	public function ApplyChanges()
	{
		parent::ApplyChanges();
	#	$this->SetTimerInterval("turn-dimmer-off", 0 )
	}
	private function isNight() {
	//prüft ob nacht ist
		//$this->ReadPropertyInteger("");

		return 1;
	}


	public function MotionDetectorEnableLight()
	{
		$DimmerID=$this->ReadPropertyInteger("DimmerID");
		$value=50;
		//$now=date("H");

		if ($this->isNight()==1){
		  $brightness=$this->ReadPropertyInteger("DimmerValueNight");
		} else {
		  $brightness=$this->ReadPropertyInteger("DimmerValueDay");
		}
		ENO_DimSet($DimmerID, $brightness);
		$seconds=5;
		$this->SetTimerInterval("OffTimer", $seconds * 1000);
		$this->SendDebug("MotionDetector","Start Light",0);
	}
	public function SwitchEnableLight()
	{
		$DimmerID=$this->ReadPropertyInteger("DimmerID");
		$value=100;
		ENO_DimSet($DimmerID, 100);
		$seconds=5;
		$this->SetTimerInterval("OffTimer", $seconds * 1000);
		$this->SendDebug("Switch","Start Light",0);
	}
		
	
  }
	
