<?php

function user_authenticate($params = array() ) {
	if ( $user_data = user_file_find($params['username']) ) {
		list($username, $salt, $encrypted_password) = $user_data;
		if ( $encrypted_password === user_encrypt_password($params['password'], $salt)) {
			return $username;
		}
	}
	return false;
}
function user_encrypt_password($str, $salt) {
	return sha1(trim($str) . $salt . cfg::secret );
}


function user_errors($params = array()) {
	$errors = array();
	if ($user_data = user_file_find($params['username'])) {
		$errors['username'] = 'username is already taken';
	}

	return (empty($errors)) ? false : $errors;
}

function user_save( $params = array() ) {
	if ($errors = user_errors($params)) {
		return array(false, $errors);
	}
	$salt = sha1(mt_rand(0,100) . cfg::secret . 'blargh');
	$encrypted_password = user_encrypt_password($params['password'], $salt);

	if (user_file_write($params['username'], $salt, $encrypted_password)) {
		return array(true, $params['username']);
	}
	return array(false, array('generic' => 'unable to save'));
}

function user_file_find($u) {
	if ( $fp = fopen(cfg::user_file(), 'r') ) {
		while($line = fgets($fp, 4096)) {
			list($username, $salt, $password) = explode(':',trim($line));
			if ($username === $u) {
				return array($username, $salt, $password);
			}
		}
	}
	return false;
}

function user_file_write($username, $salt, $password) {
	if ($fp = fopen(cfg::user_file(), 'a')) {
		if ( fwrite($fp, "{$username}:{$salt}:{$password}\n") !== false ) {
			return true;
		}
	}
	return false;
}

function user_current() {
	return (isset($_SESSION['username'])) ? $_SESSION['username'] : false;
}
function is_authenticated() {
	return (user_current()) ? true : false;
}
