<?php

if (!isset($gCms)) exit;

$db = $this->GetDb();
$this->DeleteTemplate('display');
$this->DeleteTemplate('paymentForm');
$this->DeleteTemplate('paymentSuccess');
$this->DeleteTemplate('sendDaily');

$dict = NewDataDictionary( $db );

$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_m6Payments_payments" );
$dict->ExecuteSQLArray($sqlarray);

$this->RemovePermission('Payments Admin');

// Remove all preferences for this module
$this->RemovePreference();

// And all Templates
$this->DeleteTemplate();

$this->RemoveEvent('PaymentSuccess');
$this->RemoveEvent('PaymentFail');
$this->RemoveSmartyPlugin();

cms_route_manager::del_static('',$this->GetName());

// remove templates
// and template types.
try {
  $types = CmsLayoutTemplateType::load_all_by_originator($this->GetName());
  if( is_array($types) && count($types) ) {
    foreach( $types as $type ) {
      $templates = $type->get_template_list();
      if( is_array($templates) && count($templates) ) {
	foreach( $templates as $template ) {
	  $template->delete();
	}
      }
      $type->delete();
    }
  }
}
catch( Exception $e ) {
  // log it
  audit('',$this->GetName(),'Uninstall Error: '.$e->GetMessage());
}
?>

?>