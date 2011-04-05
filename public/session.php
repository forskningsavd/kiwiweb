<?php
require dirname(__FILE__) . '/../bootstrap.php';

function on_get( $params = array() ) {
	return template(basename(__FILE__));
}

function on_post( $params = array() ) {
	if ($_SESSION['username'] = user_authenticate($params)) {
		redirect('/success.php?flash_notice='.urlencode('successfull login'));
	}
	return template(basename(__FILE__), array('flash_error' => 'failed login'));
}

function on_delete() {
	unset($_SESSION['username']);
	redirect('/');
}

run(basename(__FILE__,'.php') );
