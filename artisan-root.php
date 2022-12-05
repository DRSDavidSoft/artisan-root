#!/usr/bin/env php
<?php

$GLOBALS['is_cli'] = php_sapi_name() === 'cli';

try {
	if (!$is_cli)
		throw new Exception("This script must only be run in CLI.");
}
catch (Throwable $e) {
	header("Content-Type: text/plain", true, 500);
	if ($is_cli) {
		$message = sprintf(chr(0x07) . "\e[91;1m%s\e[0m", $e->getMessage());
	}
	else {
		$message = sprintf("%s", $e->getMessage());
	}
	die($message);
}
