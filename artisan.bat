@echo OFF
:: This is a batch script to run the artisan-root.php script on Windows
:: It uses the %~dp0 modifier to get the directory of the script
:: It disables delayed expansion to avoid issues with ! characters in paths
setlocal DISABLEDELAYEDEXPANSION
:: It passes the script path and any arguments to the php executable
php "%~dp0artisan-root.php" %*
