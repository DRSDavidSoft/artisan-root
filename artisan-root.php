#!/usr/bin/env php
<?php

// Remember where we are currently
$original_cwd = getcwd();

// Define a constant to store the CLI mode status
define('IS_CLI', php_sapi_name() === 'cli');

try {
    // Throw an exception if the script is not running in the CLI mode
    if (!IS_CLI) {
        throw new Exception("This script must only be run in CLI.");
    }

    // Get the current working directory
    $cwd = getcwd();

    // Initialize a variable to store the artisan file path
    $artisan = null;

    // Use a while loop to iterate through the parent directories
    while ($cwd) {
        // Check if the current directory is valid
        if (empty($cwd) || empty($cwd == realpath($cwd))) {
            throw new Exception("Failed to detect the current working directory.");
        }

        // Check if the current directory contains an artisan file
        if (file_exists("$cwd/artisan") && !empty(filesize("$cwd/artisan"))) {
            // Read the first line of the artisan file
            $buffer = fgets(fopen("$cwd/artisan", 'r'));

            // Check if the first line starts with the php shebang
            if (str_starts_with(trim($buffer), '#!/usr/bin/env php')) {
                // Set the artisan file path and break the loop
                $artisan = "$cwd/artisan";
                break;
            }
        }

        // Get the parent directory of the current directory
        $parentDir = realpath(dirname($cwd));

        // Check if the parent directory is different from the current directory
        if (!empty($parentDir) && $parentDir != $cwd) {
            // Set the current directory to the parent directory
            $cwd = $parentDir;
        } else {
            // Throw an exception if no artisan file is found
            throw new Exception("Can not find `artisan` in the current directory structure.");
        }
    }

    // Require the artisan file and run it
    require_once $artisan;
}
catch (Throwable $e) {
    // Set the content type header to plain text if no headers are sent
    if (!headers_sent()) {
        header("Content-Type: text/plain", true, 500);
    }

    // Use different output methods for CLI and non-CLI modes
    if (IS_CLI) {
        // Use ANSI escape codes to colorize the error message and a bell character to alert the user
        $message = sprintf(chr(0x07) . "\e[91;1m%s\e[0m\n", $e->getMessage());
        fwrite(STDERR, $message);
        die(1);
    } else {
        // Print the error message as is
        $message = sprintf("%s\n", $e->getMessage());
        die($message);
    }
}
finally {
    // Change the directory back to where we were before
    chdir($original_cwd);
}
