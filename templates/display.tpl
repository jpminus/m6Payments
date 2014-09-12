<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('div#standardForm form').addClass('form-horizontal');
  $('div#standardForm form').removeClass('form-inline');
});
</script>



{if isset($error) && $error != ''}
  <div class="alert alert-error">{$error}</div>
{elseif isset($message) && $message != ''}
  <div class="alert">{$message}</div>
{/if}


<div id="standardForm">
	{$formStart}
	<div class="form-group">
  		<label for="accountNumber" class="col-sm-3 control-label">Reference Number</label>
    		<div class="col-sm-4">
     			<input type="text" class="form-control"  name="{$actionid}accountNumber" required="required" id="accountNumber" placeholder="Reference Number" value="" >
    		</div>
	<em>For Reference Number, you can reference an invoice number, domain name or your last name.</em>

	</div>
	<div class="form-group">
  		<label for="address" class="col-sm-3 control-label">Payment Amount</label>
    		<div class="col-sm-5">
     			<input type="text" class="form-control"  name="{$actionid}paymentAmount" required="required" id="paymentAmount" placeholder="Enter Payment Amount (example 35.23)" value="">
    		</div>
	</div>
	<hr>
    	<img class="pull-right" alt="SSL Certificate" src="https://www.instantssl.com/ssl-certificate-images/support/comodo_secure_100x85_transp.png" style="border: 0px;" /><br />
	<button class="btn btn-success" type="submit">Proceed To Payment Form</button>
</div>

