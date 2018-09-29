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
	  $this->RegisterPropertyInteger("MotionDetectorTimer",60);
	  $this->RegisterPropertyInteger("SwitchTimer",60);
	 # $this->RegisterPropertyInteger("", 0);
	  # $this->RegisterPropertyInteger("", 0);
	  $variablenID = $this->RegisterVariableString("Status", "Status", "");
	  SetValue($variablenID,"");
	  $this->RegisterTimer("OffTimer", 0, "DNC_Stop(\$_IPS['TARGET']);");
	}

	public function Stop() {
	  	$variablenID = $this->RegisterVariableString("Status", "Status", "");
		$this->SetTimerInterval("OffTimer", 0);
	  	$DimmerID=$this->ReadPropertyInteger("DimmerID");
		ENO_DimSet($DimmerID,0);
		$this->SendDebug("Stop","Dimmer aus!",0);
		SetValue($variablenID,"");
	}
	
	public function ApplyChanges()
	{
		parent::ApplyChanges();
	#	$this->SetTimerInterval("turn-dimmer-off", 0 )
	
		if($this->ReadPropertyInteger("MotionDetectorID") > 0) {
			$this->RegisterMessage($this->ReadPropertyInteger("MotionDetectorID"), 10603);
		}
		if($this->ReadPropertyInteger("SwitchID") > 0) {
			$this->RegisterMessage($this->ReadPropertyInteger("SwitchID"), 10603);
		}
	
	}

	public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
	{	
		#$this->SendDebug("Message","Event:".$TimeStamp." Sender: ".json_decode($SenderID)." MSG: ".json_decode($Message)." Data: ".serialize($Data),0); 		
		if ($Message==10603 && $Data[0]==true) {
		//Variablenänderung
		if($this->ReadPropertyInteger("MotionDetectorID") == $SenderID) {
		   $this->MotionDetectorEnableLight();
		   $this->SendDebug("Keypress","MotionDetector",0);
		} else if ($this->ReadPropertyInteger("SwitchID") == $SenderID) {
		   $this->SendDebug("Keypress","Switch",0);
 		   $this->SwitchEnableLight();
		}
		}		
	
	}		

	public function Dump() {
      	   return $this->GetMessageList();
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

		//if (
	  	$variablenID = $this->RegisterVariableString("Status", "Status", "");
	$this->SendDebug("VAR",GetValue($variablenID),0);	
		if (GetValue($variablenID)<>"Switch") {
		  if ($this->isNight()==1){
		    $brightness=$this->ReadPropertyInteger("DimmerValueNight");
		  } else {
		    $brightness=$this->ReadPropertyInteger("DimmerValueDay");
	  	  }
		  ENO_DimSet($DimmerID, $brightness);
		  $seconds=$this->ReadPropertyInteger("MotionDetectorTimer");
		  $this->SetTimerInterval("OffTimer", $seconds * 1000);
		  $this->SendDebug("MotionDetector","Start Light for ".$seconds."s",0);
		  SetValue ($VariablenID, "MotionDetector");
		} else {
		// Licht ist bereits an wegen gedrücktem Switch. 
			// TODO: entscheiden was zu tun ist
		  $this->SetTimerInterval("OffTimer", $seconds * 1000);
		}	
	}

	public function SwitchEnableLight()
	{
	  	$variablenID = $this->RegisterVariableString("Status", "Status", "");
		$DimmerID=$this->ReadPropertyInteger("DimmerID");
		$value=100;
		ENO_DimSet($DimmerID, 100);
		$seconds=$this->ReadPropertyInteger("SwitchTimer");
		$this->SetTimerInterval("OffTimer", $seconds * 1000);
		$this->SendDebug("Switch","Start Light for ".$seconds."s",0);
		SetValue ($VariablenID, "Switch");
	}
		
	
  }
	
