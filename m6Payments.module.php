<?php
#-------------------------------------------------------------------------
# Module: m6Payments
# Version: 1.0, Jeff Minus
#
#-------------------------------------------------------------------------

class m6Payments extends CMSModule
{
  function GetName() { return get_class($this); }
  function GetFriendlyName() { return $this->Lang('friendlyname'); }
  function GetVersion() { return '1.0'; }
  function GetHelp() { return $this->Lang('help'); }
  function GetAuthor() { return 'Jeff Minus'; }
  function GetAuthorEmail() { return 'jeff@m6digital.com'; }
  function GetChangeLog() { return $this->Lang('changelog'); }
  function IsPluginModule() { return true; }
  function LazyLoadAdmin() { return TRUE; }
  function LazyLoadFrontend() { return TRUE; }
  function HasAdmin() { return TRUE; }
  function GetAdminSection() { return 'content'; }
  function GetAdminDescription() { return $this->Lang('admindescription'); }
  function VisibleToAdminUser() { return TRUE; }
  function GetDependencies() { return array(); }
  function MinimumCMSVersion() { return "1.10"; }
  function InstallPostMessage() { return $this->Lang('postinstall'); }
  function UninstallPostMessage() { return $this->Lang('postuninstall'); }
  function UninstallPreMessage() { return $this->Lang('really_uninstall'); }
	
  function InitializeFrontend()
  {
    
    //$this->RestrictUnknownParams();
    $this->SetParameterType('Submit',CLEAN_STRING);
    $this->SetParameterType('Cancel',CLEAN_STRING);
    $this->SetParameterType('message',CLEAN_STRING);

	// PAYMENT DETAILS
    $this->SetParameterType('transID',CLEAN_INT);
    $this->SetParameterType('email',CLEAN_STRING);	
    $this->SetParameterType('accountNumber',CLEAN_STRING);
    $this->SetParameterType('paymentAmount',CLEAN_FLOAT);
    $this->SetParameterType('firstName',CLEAN_STRING);	
    $this->SetParameterType('lastName',CLEAN_STRING);	
    $this->SetParameterType('address',CLEAN_STRING);	
    $this->SetParameterType('city',CLEAN_STRING);	
    $this->SetParameterType('state',CLEAN_STRING);	
    $this->SetParameterType('zip',CLEAN_STRING);	
    $this->SetParameterType('phone',CLEAN_STRING);	

  }

}
 
?>