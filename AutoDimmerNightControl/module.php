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
	  #$variablenID = $this->RegisterVariableString("Status", "Status", "");
	  #SetValue($variablenID,"");
	  $this->RegisterTimer("OffTimer", 0, "DNC_Stop(\$_IPS['TARGET']);");
	  $this->SetBuffer("StartEvent","");
	}

	public function Stop() {
	  	#$variablenID = $this->RegisterVariableString("Status", "Status", "");
		$this->SetTimerInterval("OffTimer", 0);
	  	$DimmerID=$this->ReadPropertyInteger("DimmerID");
		ENO_DimSet($DimmerID,0);
		$this->SendDebug("Stop","Dimmer aus!",0);
	//	SetValue($variablenID,"");
		$this->SetBuffer("StartEvent","");
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
	  $night=0;
	  $night = $this->ReadPropertyInteger("NightStartTime");
	  $day = $this->ReadPropertyInteger("DayStartTime");
	  $hour = date("G");
	  
	  //$night=$night+24;

	 /* if ($night < $day ) {
             $night = $night+24;
	  }*/

	  if ($hour >= $day && $hour < $night) {
		    $night=0;
	  } else {$night=1;}
	  /*
night	2 26 	4     6  23 6     23
day	7 	10    5   6 4     7
now	4	23    8   1 5     13
	   */
	  return $night;
	}


	public function MotionDetectorEnableLight()
	{
		$DimmerID=$this->ReadPropertyInteger("DimmerID");
		$value=50;
		//$now=date("H");

		//if (
	  	#$variablenID = $this->RegisterVariableString("Status", "Status", "");
		#$this->SendDebug("VAR",GetValue($variablenID),0);	
		if ($this->GetBuffer("StartEvent")<>"Switch") {
		  if ($this->isNight()==1){
		    $brightness=$this->ReadPropertyInteger("DimmerValueNight");
		  } else {
		    $brightness=$this->ReadPropertyInteger("DimmerValueDay");
	  	  }
		  ENO_DimSet($DimmerID, $brightness);
		  $seconds=$this->ReadPropertyInteger("MotionDetectorTimer");
		  $this->SetTimerInterval("OffTimer", $seconds * 1000);
		  $this->SendDebug("MotionDetector","Start Light for ".$seconds."s",0);
		  $this->SetBuffer("StartEvent","MotionDetector");
		} else {
		// Licht ist bereits an wegen gedrücktem Switch. 
			// TODO: entscheiden was zu tun ist
		  $seconds=$this->ReadPropertyInteger("MotionDetectorTimer");
		  $this->SetTimerInterval("OffTimer", $seconds * 1000);
		  $this->SendDebug("MotionDetector","Renew Timer for ".$seconds."s",0);
		}	
	}

	public function SwitchEnableLight()
	{
		$DimmerID=$this->ReadPropertyInteger("DimmerID");
		$value=100;
		ENO_DimSet($DimmerID, 100);
		$seconds=$this->ReadPropertyInteger("SwitchTimer");
		$this->SetTimerInterval("OffTimer", $seconds * 1000);
		$this->SendDebug("Switch","Start Light for ".$seconds."s",0);
		$this->SetBuffer("StartEvent","Switch");
	}
		
	
  }
	
