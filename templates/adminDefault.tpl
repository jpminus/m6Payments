<h3>m6Digital Registration Module Administration</h3>
{$tab_headers}


{$start_config_tab}
<h3>Module Configuration</h3>
<p>This allows you to set all the system defaults and configures the API access for Stripe for processing payments.</p>
{$configFormStart}
<div class="pageoverflow">
	<p class="pagetext">Admin Email Address</p>
    	<p class="pageinput">{$adminEmail}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">Event Title</p>
    	<p class="pageinput">{$eventTitle}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">Mode</p>
    	<p class="pageinput">{$testMode}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">Stripe Test Mode Secret Key</p>
    	<p class="pageinput">{$testSecretKey}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">Stripe Live Mode Secret Key</p>
    	<p class="pageinput">{$liveSecretKey}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">Stripe Test Mode Publish Key</p>
    	<p class="pageinput">{$testPublishKey}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">Stripe Live Mode Publish Key</p>
    	<p class="pageinput">{$livePublishKey}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput"><input class="cms_submit" value="Submit" type="submit" /></p>
</div>
{$configFormEnd}
{$end_tab}



{$start_payments_tab}
<table class="pagetable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Account</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>ChargeID</th>
      <th>Timestamp</th>

    </tr>
  </thead>
  <tbody>
{section name=element loop=$registrants}
    <tr>
      <td>{$registrants[element].transID}</td>
      <td>{$registrants[element].accountNumber}</td>
      <td>{$registrants[element].firstName}</td>
      <td>{$registrants[element].lastName}</td>
      <td>{$registrants[element].email}</td>
      <td>{$registrants[element].phone}</td>
      <td>{$registrants[element].chargeID}</td>
      <td>{$registrants[element].timestamp}</td>
    </tr>
  {/section}
  </tbody>
</table>

{$end_tab}

{$start_confirmation_tab}
<p>Adjust the text that is displayed in the confirmation email.</p>

{$end_tab}

{$tab_footers}

