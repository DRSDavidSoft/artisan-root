#!/usr/bin/env php
<?php

$original_cwd = getcwd();
$GLOBALS['is_cli'] = php_sapi_name() === 'cli';

try {
	if (!$is_cli)
		throw new Exception("This script must only be run in CLI.");

	$cwd = getcwd();

	do {
		if (empty($cwd) || empty($cwd == realpath($cwd)))
			throw new Exception("Failed to detect the current working directory.");

		if (file_exists('artisan'))
			return require_once 'artisan';

		if (!empty($parentDir = realpath(dirname($cwd))) && $parentDir != $cwd)
			$cwd = $parentDir;
		else
			throw new Exception("Can not find `artisan` in the current directory structure.");

		if (!chdir($cwd))
			throw new Exception("Failed to lookup directory: $cwd");
	}
	while ($cwd);
}
catch (Throwable $e) {
	if (!headers_sent())
		header("Content-Type: text/plain", true, 500);

	if ($is_cli)
		$message = sprintf(chr(0x07) . "\e[91;1m%s\e[0m", $e->getMessage());
	else
		$message = sprintf("%s", $e->getMessage());

	die($message);
}
finally {
	chdir($original_cwd);
}
