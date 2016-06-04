<?php

namespace NuitDebout\Wordpress\Coordination;

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\SpreadsheetService;

function get_access_token()
{
	$client = new \Google_Client();
	$client->setApplicationName('NuitDebout Coordination');

	$scopes = [
		'https://spreadsheets.google.com/feeds',
	];
	$data = json_decode(GOOGLE_API_SERVICE_ACCOUNT_CREDENTIALS);
    if (isset($data->type) && $data->type == 'service_account') {
      $credentials = new \Google_Auth_AssertionCredentials(
          $data->client_email,
          $scopes,
          $data->private_key
      );
    } else {
      throw new \Google_Exception("Invalid service account JSON file.");
    }

	$client->setAssertionCredentials($credentials);

	if ($client->getAuth()->isAccessTokenExpired()) {
	  $client->getAuth()->refreshTokenWithAssertion();
	}

	$tokenJson = json_decode($client->getAccessToken(), true);

	return $tokenJson['access_token'];
}

function get_spreadsheet_data()
{
	$serviceRequest = new DefaultServiceRequest(get_access_token());
	ServiceRequestFactory::setInstance($serviceRequest);

	$spreadsheetService = new SpreadsheetService();

	$spreadsheet = $spreadsheetService->getSpreadsheetById('15udVvrHolBdACescDQeGfDLmbebkytiahhQmzk3L2EA');

	foreach ($spreadsheet->getWorksheets() as $ws) {
		if ($ws->getTitle() === 'Contacts coordination') {

			return $ws->getCellFeed()->toArray();
		}
	}
}

function render_spreadsheet_table($attrs)
{
	$data = get_spreadsheet_data();

	$commissions = [];

	foreach ($data as $rowNum => $row) {
		if ($rowNum >= 3) {
			$publicEmails = $row[7];
			$publicEmails = explode(PHP_EOL, $publicEmails);
			$commissions[] = [
				'name' => $row[2],
				'referent' => $row[3],
				'public_emails' => $publicEmails,
			];
		}
	}

	$html = <<<EOF
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>Nom</th>
			<th>Référent</th>
			<th>Emails</th>
		</thead>
		<tbody>
EOF;
	foreach ($commissions as $commission) {
		$emails = implode('<br>', $commission['public_emails']);
		$row = <<<EOF
<tr>
	<td>{$commission['name']}</td>
	<td>{$commission['referent']}</td>
	<td>{$emails}</td>
</tr>
EOF;
		$html .= $row;
	}
	$html .= '</tbody></table></div>';

	return $html;
}

add_shortcode('nd_coord_contacts', __NAMESPACE__ . '\\render_spreadsheet_table');