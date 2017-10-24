<?php
/* Connect to Database */
function connectReuseDB() {

	// credentials
	$DBUrl = getenv('REUSE_DB_URL');
	$DBUser = getenv('REUSE_DB_USER');
	$DBPw = getenv('REUSE_DB_PW');
	$DBName = getenv('REUSE_DB_NAME');

	static $database;
	if (!isset($database)) {
		$database = new mysqli($DBUrl, $DBUser, $DBPw, $DBName);
		if ($database->connect_errno) {
			echo "Failed to connect to database (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			exit();
		}
	}

	return $database;
}
