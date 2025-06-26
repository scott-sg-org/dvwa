<?php

function custom_sanitize($input) {
	return escapeshellarg($input);
}

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Get input
	$target = custom_sanitize($_REQUEST[ 'ip' ]);

	// Determine OS and execute the ping command.
	if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
		// Windows
		$cmd = shell_exec( 'ping  ' . $target );
	}
	else {
		// *nix
		$cmd = shell_exec( 'ping  -c 4 ' . $target );
	}

	// Feedback for the end user
	$html .= "<pre>{$cmd}</pre>";
}

?>
