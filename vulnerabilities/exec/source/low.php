<?php

function simple_sanitize($input) {
    $regex = '/^(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])\.' .
             '(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])\.' .
             '(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])\.' .
             '(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])$/';
    if (preg_match($regex, $input)) {
        return $input;
    }
    return '127.0.0.1';
}

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Get input
	$target = simple_sanitize($_REQUEST[ 'ip' ]);

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
