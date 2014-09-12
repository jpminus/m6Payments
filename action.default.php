<?php


if(isset($params['message'])){
	$smarty->assign('message',$params['message']);
}


$smarty->assign('actionID', $actionID);
$smarty->assign('formStart', $this->CreateFrontendFormStart($id,$returnid,'showForm','post','',TRUE));



echo $this->ProcessTemplate('display.tpl');

?>