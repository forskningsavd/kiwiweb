<?php
require dirname(__FILE__).'/../bootstrap.php';

function validate($params) {
	$errors = array();
	if (empty($params['username'])) {
		$errors['username'] = 'need to specify a username';
	}
	if (empty($params['email'])) {
		$errors['email'] = 'need to specify a email';
	}
	if (strlen($params['password']) < 2) {
		$errors['password'] = 'need to have a password';
	}
	return (empty($errors)) ? false : $errors;
}

function on_get($params = array()) {
	if (isset($params['new'])) {
		$params['title'] = 'create a new user!';
	}

	return template(basename(__FILE__), $params);
}

function on_post($params) {
	$user_create = user_save($params);

	$ok = array_shift($user_create);
	if (!$ok) {
		$params['user_errors'] = array_shift($user_create);
		return template(basename(__FILE__), $params);
	}
	redirect('/success.php?flash_notice='.urlencode('a new user was registered'));
}

echo run(basename(__FILE__, '.php'));
