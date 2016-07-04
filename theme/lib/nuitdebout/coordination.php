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

function letter_to_col($letter)
{
	$ord = ord(strtolower($letter));

	return $ord - 96;
}

function render_spreadsheet_table($atts)
{
	$atts = shortcode_atts([
		'cols' => 'B,C,G',
	], $atts, 'nd_coord_contacts');

	$cols = explode(',', $atts['cols']);

	$data = get_spreadsheet_data();

	$headings = [];
	foreach ($data as $rowNum => $row) {
		if ($rowNum == 2) {
			foreach ($cols as $col) {
				$headings[] = $row[letter_to_col($col)];
			}
		}
	}

	$nl2br = ['D', 'E', 'F', 'G'];

	$commissions = [];
	foreach ($data as $rowNum => $row) {
		if ($rowNum >= 3) {

			$item = [];
			foreach ($cols as $col) {
				$value = $row[letter_to_col($col)];
				if (in_array($col, $nl2br)) {
					$value = nl2br($value);
				}
				$item[] = $value;
			}

			$commissions[] = $item;
		}
	}

	$thead = '<thead><th>'.implode('</th><th>', $headings).'</th></thead>';

	$html .= <<<EOF
<div class="table-responsive">
	<table class="table">
		{$thead}
		<tbody>
EOF;
	foreach ($commissions as $commission) {
		$row = '<tr><td>'.implode('</td><td>', $commission).'</td></tr>';
		$html .= $row;
	}
	$html .= '</tbody></table></div>';

	return $html;
}

add_shortcode('nd_coord_contacts', __NAMESPACE__ . '\\render_spreadsheet_table');