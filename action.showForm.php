<?php

if(isset($params['message'])){
	$smarty->assign('message',$params['message']);
}

if($this->GetPreference('testMode')=="Test"){
$publishKey=$this->GetPreference("testPublishKey");
}

if($this->GetPreference('testMode')=="Live"){
$publishKey=$this->GetPreference("livePublishKey");
}

$smarty->assign('publishKey',$publishKey);

$accountNumber=$params['accountNumber'];
$paymentAmount=$params['paymentAmount'];


if($accountNumber == ""){
	$params['message']="Account Number Cannot Be Blank!";
	$this->RedirectForFrontEnd($id,$returnid,'default',$params);
}

if($paymentAmount == ""){
	$params['message']="Payment Amount Cannot Be Blank!";
	$this->RedirectForFrontEnd($id,$returnid,'default',$params);
}


if($paymentAmount == "0"){
	$params['message']="Please enter payment using numbers only!";
	$this->RedirectForFrontEnd($id,$returnid,'default',$params);
	}




$sexList = array('-'=>'-','M'=>'M','F'=>'F');
$sizeList = array('-'=>'-','S'=>'S','M'=>'M','L'=>'L','XL'=>'XL','XXL'=>'XXL');
$stateList = array(
    'IL'=>'Illinois',
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming'
);

$monthList = array(
	'Select'=>'Select',
	'01'=>'01',
	'02'=>'02',
	'03'=>'03',
	'04'=>'04',
	'05'=>'05',
	'06'=>'06',
	'07'=>'07',
	'08'=>'08',
	'09'=>'09',
	'10'=>'10',
	'11'=>'11',
	'12'=>'12'
);

$yearList = array(
	'Select'=>'Select',
	'2014'=>'2014',
	'2015'=>'2015',
	'2016'=>'2016',
	'2017'=>'2017',	
	'2018'=>'2018',
	'2019'=>'2019',	
	'2020'=>'2020',
	'2021'=>'2021'
);
 

$smarty->assign('accountNumber',$accountNumber);
$smarty->assign('paymentAmount',$paymentAmount);
$smarty->assign('stateList',$stateList);
$smarty->assign('monthList',$monthList);
$smarty->assign('yearList',$yearList);


$smarty->assign('actionID', $actionID);
$smarty->assign('formStart', $this->CreateFrontendFormStart($id,$returnid,'charge','post'));

//need to pass the form ID to the javascript in the action charge for the ajax to work right
$smarty->assign('formID','#'.$id.'moduleform_1');
$smarty->assign('params',$params);

echo $this->ProcessTemplate('paymentForm.tpl');

?>