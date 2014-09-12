<?PHP

require_once('Stripe.php');


date_default_timezone_set("America/Chicago"); 

//debug_display($params);
$accountNumber=$params['accountNumber'];
$paymentAmount=$params['paymentAmount'];
$firstName=$params['firstName'];
$lastName=$params['lastName'];
$email=$params['email'];
$address=$params['address'];
$city=$params['city'];
$state=$params['state'];
$zip=$params['zip'];
$age=$params['age'];
$sex=$params['sex'];
$phone=$params['phone'];
$timestamp=date("Y-m-d H:i:s");


$paymentAmount=$paymentAmount*100; //convert to cents

//assign stuff to smarty for receipt and confirmation page outputs
$smarty->assign('params',$params);
$smarty->assign('eventName',$eventName);


// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://manage.stripe.com/account

if($this->GetPreference('testMode')=="Test"){
$secretKey=$this->GetPreference("testSecretKey");
Stripe::setApiKey($secretKey);
}

if($this->GetPreference('testMode')=="Live"){
$secretKey=$this->GetPreference("liveSecretKey");
Stripe::setApiKey($secretKey);
}


// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];


// Create the charge on Stripe's servers - this will charge the user's card
try 	{
	$charge = Stripe_Charge::create(array(
  		"amount" => $paymentAmount, // amount in cents
  		"currency" => "usd",
  		"card" => $token,
  		"description" => $email,
		"statement_description" => $this->GetPreference('eventTitle')));
	}


	
	catch(Stripe_CardError $e) {
		$params['message']="The attempt to process the payment failed because the card was declined"; 
		$this->RedirectForFrontEnd($id,$returnid,'showForm',$params);
	}
	catch(Stripe_InvalidRequestError $e) {
		$params['message']="There was a problem processing your payment. Perhaps you tried to submit twice? Check your email for previous confirmation.";
		$this->RedirectForFrontEnd($id,$returnid,'showForm',$params);
	}



	// Send Receipt & Confirmation
	$subject = $this->GetPreference('eventTitle');
      	$to = $email;
      	$from = $this->GetPreference('adminEmail');
      	$smarty->assign('params',$params);
      	$body = $this->ProcessTemplate('paymentSuccess.tpl');
      	$mailer = cms_utils::get_module('CMSMailer');
      	$mailer->reset();
      	$mailer->SetSubject($subject);
	$mailer->IsHTML(true);
      	$mailer->SetBody($body);
      	$mailer->AddAddress($to);
      	$mailer->SetFrom($from);
      	$res = $mailer->Send();

	// If we got to here there are no errors and we can record the entry.

	$chargeID=$charge->id;
	$chargePaid=$charge->paid;
	$query = "INSERT INTO ".cms_db_prefix()."module_m6payments_payments 
		(transID,accountNumber,paymentAmount,firstName,lastName,email,address,city,state,zip,phone,chargeID,chargePaid,timestamp) 
		VALUES 
		('','$accountNumber','$paymentAmount','$firstName','$lastName','$email','$address','$city','$state','$zip','$phone','$chargeID','$chargePaid','$timestamp')";

	$dbr = $db->Execute($query);
	if( !$dbr ) {
		$params['message']="There was a problem updating the record in the database";
		$this->RedirectForFrontEnd($id,$returnid,'showForm',$params);
   	 }

	echo $this->ProcessTemplate('paymentSuccess.tpl');

?>