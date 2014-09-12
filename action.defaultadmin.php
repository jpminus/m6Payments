<?PHP




$this->smarty->assign('tab_headers',$this->StartTabHeaders().
	$this->SetTabHeader('config','Module Configuration',$tab=='config'?true:false).
	$this->SetTabHeader('payments','Payments',$tab=='payments'?true:false).
	$this->SetTabHeader('confirmation','Confirmation Template',$tab=='confirmation'?true:false).
	$this->EndTabHeaders().$this->StartTabContent());
$smarty->assign('end_tab',$this->EndTab());
$smarty->assign('tab_footers',$this->EndTabContent());
$smarty->assign('start_config_tab',$this->StartTab('config'));
$smarty->assign('start_payments_tab',$this->StartTab('payments'));
$smarty->assign('start_confirmation_tab',$this->StartTab('confirmation'));



$smarty->assign('configFormStart',$this->CreateFormStart($id,'setPreferences',$returnid,'post','multipart/form-data'));
$smarty->assign('adminEmail',$this->CreateInputText($id,'adminEmail',$this->GetPreference('adminEmail'),40));
$smarty->assign('eventTitle',$this->CreateInputText($id,'eventTitle',$this->GetPreference('eventTitle'),40));
$smarty->assign('testMode',$this->CreateInputDropdown($id,'testMode',array("Live"=>"Live","Test"=>"Test"),'',$this->GetPreference('testMode')));
$smarty->assign('testSecretKey',$this->CreateInputText($id,'testSecretKey',$this->GetPreference('testSecretKey'),40));
$smarty->assign('testPublishKey',$this->CreateInputText($id,'testPublishKey',$this->GetPreference('testPublishKey'),40));
$smarty->assign('liveSecretKey',$this->CreateInputText($id,'liveSecretKey',$this->GetPreference('liveSecretKey'),40));
$smarty->assign('livePublishKey',$this->CreateInputText($id,'livePublishKey',$this->GetPreference('livePublishKey'),40));
$smarty->assign('configFormEnd',$this->CreateFormEnd());




$sql = 'SELECT * FROM ' . cms_db_prefix().'module_m6payments_payments';
$dbresult =& $db->Execute($sql);
$regs = array();
while ($dbresult && $row = $dbresult->FetchRow())
	{ 
	$i = count($regs);
	$regs[$i]['transID'] = $row['transID'];
	$regs[$i]['accountNumber'] = $row['accountNumber'];
	$regs[$i]['firstName'] = $row['firstName'];
	$regs[$i]['lastName'] = $row['lastName'];
	$regs[$i]['email'] = $row['email'];
	$regs[$i]['phone'] = $row['phone'];
	$regs[$i]['chargeID'] = $row['chargeID'];
	$regs[$i]['timestamp'] = $row['timestamp'];

	}
$smarty->assign('registrants', $regs);	



echo $this->ProcessTemplate('adminDefault.tpl');



?>