<?php
if (!isset($gCms)) exit;

$uid = null;
if( cmsms()->test_state(CmsApp::STATE_INSTALL) ) {
  $uid = 1; // hardcode to first user
} else {
  $uid = get_userid();
}


//CREATE PAYMENTS TABLE

$db = $this->GetDb();

$dict = NewDataDictionary($db);
$flds = "
	transID I KEY,
	accountNumber (C100),
	paymentAmount C(100),
	totalAmount C(20),
	merchantFee C(20),
	firstName C(50),
	lastName C(50),
	email C(50),
	address C(150),
	city C(100),
	state C(50),
	zip C(20),
	phone C(25),
	chargeID C(100),
	chargePaid C(10),	
	timestamp " . CMS_ADODB_DT . ",
	mode C(10)";



$taboptarray = array('mysql' => 'TYPE=MyISAM');
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_news", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

//CREATE PERMISSIONS

$this->CreatePermission('Payments Admin', 'Administration Role for Payments Module');

//SETUP PAYMENT TEMPLATE
try {
  $payment_template_type = new CmsLayoutTemplateType();
  $payment_template_type->set_originator($this->GetName());
  $payment_template_type->set_name('summary');
  $payment_template_type->set_dflt_flag(TRUE);
  $payment_template_type->set_lang_callback('News::page_type_lang_callback');
  $payment_template_type->set_content_callback('News::reset_page_type_defaults');
  $payment_template_type->reset_content_to_factory();
  $payment_template_type->save();
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

try {
  $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'display.tpl';
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $tpl = new CmsLayoutTemplate();
    $tpl->set_name('Initial Payment Form');
    $tpl->set_owner($uid);
    $tpl->set_content($template);
    $tpl->set_type($payment_template_type);
    $tpl->set_type_dflt(TRUE);
    $tpl->save();
  }
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

//FULL PAYMENT FORM TEMPLATE
try {
  $form_template_type = new CmsLayoutTemplateType();
  $form_template_type->set_originator($this->GetName());
  $form_template_type->set_name('summary');
  $form_template_type->set_dflt_flag(TRUE);
  $form_template_type->set_lang_callback('News::page_type_lang_callback');
  $form_template_type->set_content_callback('News::reset_page_type_defaults');
  $form_template_type->reset_content_to_factory();
  $form_template_type->save();
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

try {
  $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'paymentForm.tpl';
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $tpl = new CmsLayoutTemplate();
    $tpl->set_name('Full Payment Form');
    $tpl->set_owner($uid);
    $tpl->set_content($template);
    $tpl->set_type($form_template_type);
    $tpl->set_type_dflt(TRUE);
    $tpl->save();
  }
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

//PAYMENT SUCCESS
try {
  $success_template_type = new CmsLayoutTemplateType();
  $success_template_type->set_originator($this->GetName());
  $success_template_type->set_name('summary');
  $success_template_type->set_dflt_flag(TRUE);
  $success_template_type->set_lang_callback('News::page_type_lang_callback');
  $success_template_type->set_content_callback('News::reset_page_type_defaults');
  $success_template_type->reset_content_to_factory();
  $success_template_type->save();
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

try {
  $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'paymentSuccess.tpl';
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $tpl = new CmsLayoutTemplate();
    $tpl->set_name('Payment Success');
    $tpl->set_owner($uid);
    $tpl->set_content($template);
    $tpl->set_type($success_template_type);
    $tpl->set_type_dflt(TRUE);
    $tpl->save();
  }
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

//PAYMENT LOG
try {
  $log_template_type = new CmsLayoutTemplateType();
  $log_template_type->set_originator($this->GetName());
  $log_template_type->set_name('summary');
  $log_template_type->set_dflt_flag(TRUE);
  $log_template_type->set_lang_callback('News::page_type_lang_callback');
  $log_template_type->set_content_callback('News::reset_page_type_defaults');
  $log_template_type->reset_content_to_factory();
  $log_template_type->save();
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

try {
  $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'sendDaily.tpl';
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $tpl = new CmsLayoutTemplate();
    $tpl->set_name('Payment Success');
    $tpl->set_owner($uid);
    $tpl->set_content($template);
    $tpl->set_type($log_template_type);
    $tpl->set_type_dflt(TRUE);
    $tpl->save();
  }
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

//ADMIN DEFAULT
try {
  $admin_template_type = new CmsLayoutTemplateType();
  $admin_template_type->set_originator($this->GetName());
  $admin_template_type->set_name('summary');
  $admin_template_type->set_dflt_flag(TRUE);
  $admin_template_type->set_lang_callback('News::page_type_lang_callback');
  $admin_template_type->set_content_callback('News::reset_page_type_defaults');
  $admin_template_type->reset_content_to_factory();
  $admin_template_type->save();
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

try {
  $fn = dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'adminDefault.tpl';
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $tpl = new CmsLayoutTemplate();
    $tpl->set_name('Payment Success');
    $tpl->set_owner($uid);
    $tpl->set_content($template);
    $tpl->set_type($admin_template_type);
    $tpl->set_type_dflt(TRUE);
    $tpl->save();
  }
}
catch( CmsException $e ) {
  // log it
  debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}


$this->CreatePermission('m6Payments', 'Modify m6Paymnents');
$this->Audit( '', $this->Lang('friendlyname'), $this->Lang('installed',$this->GetVersion()));

// Setup events
$this->CreateEvent('PaymentSuccess');
$this->CreateEvent('PaymentFail');

$this->RegisterModulePlugin(TRUE);
$this->CreateStaticRoutes();

		
?>


