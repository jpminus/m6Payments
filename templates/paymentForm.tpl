<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('div#standardForm form').addClass('form-horizontal');
  $('div#standardForm form').removeClass('form-inline');
});
</script>
<script type="text/javascript">
// This identifies your website in the createToken call below
Stripe.setPublishableKey('{$publishKey}');

var stripeResponseHandler = function(status, response) {
	var $form = $('{$formID}');
 	//var $form = $('#payment-form');
	if (response.error) {
		// Show the errors on the form
		$form.find('.payment-errors').text(response.error.message);
		$form.find('button').prop('disabled', false);
		} else {
		// token contains id, last4, and card type
		var token = response.id;
		// Insert the token into the form so it gets submitted to the server
		$form.append($('<input type="hidden" name="stripeToken" />').val(token));
		// and re-submit
		$form.get(0).submit();
	}
};
 

jQuery(function($) {
	$('{$formID}').submit(function(e) {
		var $form = $(this);
 
		// Disable the submit button to prevent repeated clicks
		$form.find('button').prop('disabled', true);
 		Stripe.card.createToken($form, stripeResponseHandler);
 	
		// Prevent the form from submitting with the default action
		return false;
	});
});
</script>



{if isset($error) && $error != ''}
  <div class="alert alert-error">{$error}</div>
{elseif isset($message) && $message != ''}
  <div class="alert">{$message}</div>
{/if}




<h3>Payment Amount: ${$paymentAmount|number_format:2} for Account Number: {$accountNumber}</h3>


<div id="standardForm">
	{$formStart}
	<input type="hidden" name="{$actionid}paymentAmount" value="{$params.paymentAmount}" >
	<input type="hidden" name="{$actionid}accountNumber" value="{$params.accountNumber}" >
	<p><em>All fields must be completed prior to submitting!</em></p>
	<div class="form-group">
  		<label for="firstName" class="col-sm-2 control-label">First Name</label>
    		<div class="col-sm-4">
     			<input type="text" class="form-control"  name="{$actionid}firstName" required="required" id="firstName" placeholder="First Name" value="{$params.firstName}" >
    		</div>
  		<label for="lastName" class="col-sm-2 control-label">Last Name</label>
    		<div class="col-sm-4">
     			<input type="text" class="form-control"  name="{$actionid}lastName" required="required" id="lastName" placeholder="Last Name" value="{$params.lastName}">
    		</div>
	</div>
	<div class="form-group">
  		<label for="email" class="col-sm-2 control-label">Email Address</label>
    		<div class="col-sm-4">
     			<input type="email" class="form-control"  name="{$actionid}email" required="required" id="email" placeholder="Email" value="{$params.email}">
    		</div>
  		<label for="phone" class="col-sm-2 control-label">Phone Number</label>
    		<div class="col-sm-4">
     			<input type="text" class="form-control"  name="{$actionid}phone" required="required" id="phone" placeholder="Phone" value="{$params.phone}">
    		</div>
	</div>
	<div class="form-group">
  		<label for="address" class="col-sm-2 control-label">Street Address</label>
    		<div class="col-sm-10">
     			<input type="text" class="form-control"  name="{$actionid}address" required="required" id="address" placeholder="Street Address" value="{$params.address}">
    		</div>
	</div>
	<div class="form-group">
  		<label for="city" class="col-sm-2 control-label">City</label>
    		<div class="col-sm-2">
     			<input type="text" class="form-control"  name="{$actionid}city" required="required" id="city" placeholder="City" value="{$params.city}">
    		</div>
  		<label for="state" class="col-sm-2 control-label">State</label>
    		<div class="col-sm-2">
			<select class="form-control" id="state" name="{$actionid}state">
				{html_options options=$stateList selected="$params.state"}
			</select>
    		</div>
  		<label for="zip" class="col-sm-2 control-label">Zip</label>
    		<div class="col-sm-2">
     			<input type="text" class="form-control"  name="{$actionid}zip" required="required" id="zip" placeholder="Zip" value="{$params.zip}">
    		</div>
	</div>
  	
	<hr>
	
	<h3>Payment Form</h3>
	<span class="payment-errors"></span>
	<div class="form-group">
  		<label for="cardName" class="col-sm-2 control-label">Cardholder Name</label>
    		<div class="col-sm-10">
     			<input type="text" class="form-control" data-stripe="name" required="required" placeholder="Name as it appears on card">
    		</div>
	</div>
	<div class="form-group">
  		<label for="cardNumber" class="col-sm-2 control-label">Card Number</label>
    		<div class="col-sm-10">
     			<input type="text" class="form-control" data-stripe="number" placeholder="Enter Card Number Without Dashes">
    		</div>
	</div>
	<div class="form-group">
  		<label for="expMonth" class="col-sm-2 control-label">Exp Month</label>
    		<div class="col-sm-2">
			<select class="form-control" data-stripe="exp-month">
				{html_options options=$monthList}
			</select>
    		</div>
  		<label for="expYear" class="col-sm-2 control-label">Exp Year</label>
    		<div class="col-sm-2">
			<select class="form-control" data-stripe="exp-year">
				{html_options options=$yearList}
			</select>
    		</div>
  		<label for="cvc" class="col-sm-2 control-label">CVC</label>
    		<div class="col-sm-2">
     			<input type="text" class="form-control" data-stripe="cvc" placeholder="3 Digit CVC Code">
    		</div>
	</div>
    	<img class="pull-right" alt="SSL Certificate" src="https://www.instantssl.com/ssl-certificate-images/support/comodo_secure_100x85_transp.png" style="border: 0px;" /><br />
	<button class="btn btn-success" type="submit">Submit Payment</button>
	</form>
</div>

