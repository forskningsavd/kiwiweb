<?php
require_once dirname(__FILE__).'/../bootstrap.php';

function on_get($params) {
	return template(basename(__FILE__), $params);
}

run(basename(__FILE__,'.php'));
