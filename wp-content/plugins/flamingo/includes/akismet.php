<?php

function flamingo_akismet_submit_spam( $comment ) {
	return flamingo_akismet_submit( $comment, 'spam' );
}

function flamingo_akismet_submit_ham( $comment ) {
	return flamingo_akismet_submit( $comment, 'ham' );
}

function flamingo_akismet_submit( $comment, $as = 'spam' ) {
	global $akismet_api_host, $akismet_api_port;

	if ( ! flamingo_akismet_is_active() )
		return false;

	if ( ! in_array( $as, array( 'spam', 'ham' ) ) )
		return false;

	$query_string = '';

	foreach ( (array) $comment as $key => $data )
		$query_string .= $key . '=' . urlencode( wp_unslash( (string) $data ) ) . '&';

	if ( is_callable( array( 'Akismet', 'http_post' ) ) ) { // Akismet v3.0+
		$response = Akismet::http_post( $query_string, 'submit-' . $as );
	} else {
		$response = akismet_http_post( $query_string, $akismet_api_host,
			'/1.1/submit-' . $as, $akismet_api_port );
	}

	return (bool) $response[1];
}

function flamingo_akismet_is_active() {
	if ( is_callable( array( 'Akismet', 'get_api_key' ) ) ) { // Akismet v3.0+
		return (bool) Akismet::get_api_key();
	}

	if ( function_exists( 'akismet_get_key' ) ) {
		return (bool) akismet_get_key();
	}

	return false;
}

?>