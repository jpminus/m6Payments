<?PHP

$adminEmail=$params['adminEmail'];
$testMode=$params['testMode'];
$testSecretKey=$params['testSecretKey'];
$liveSecretKey=$params['liveSecretKey'];
$testPublishKey=$params['testPublishKey'];
$livePublishKey=$params['livePublishKey'];

$eventTitle=$params['eventTitle'];


//if(isset($params['chargeListings'])){$this->SetPreference('chargeListings',$params['chargeListings']);}else{$this->SetPreference('chargeListings',0);}
				
$this->SetPreference('testMode',$testMode);
$this->SetPreference('eventTitle',$eventTitle);
$this->SetPreference('adminEmail',$adminEmail);
$this->SetPreference('testSecretKey',$testSecretKey);
$this->SetPreference('liveSecretKey',$liveSecretKey);
$this->SetPreference('testPublishKey',$testPublishKey);
$this->SetPreference('livePublishKey',$livePublishKey);
	
$this->Redirect($id, 'defaultadmin', '',array('module message'=>'Configuration Updated'));

?>