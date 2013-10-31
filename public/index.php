<?php
$extensions = get_loaded_extensions();
$necessary = array('Core', 'libxml', 'filter', 'SPL', 'standard', 'phalcon', 'pdo_mysql');
$flag = true;
for ($i=0; $i<count($necessary); $i++) {
	if (!in_array($necessary[$i], $extensions)) {
		$flag = false;
		print "<strong>{$necessary[$i]}</strong> did not loaded.<br>";
	}
}
if ($flag) print '<strong>All of necessaries has loaded.</strong>';
error_reporting(E_ALL);

try {

	/**
	 * Read the configuration
	 */
	$config = require __DIR__ . "/../app/config/config.php";

	/**
	 * Include loader
	 */
	require __DIR__ . '/../app/config/loader.php';

	/**
	 * Include services
	 */
	require __DIR__ . '/../app/config/services.php';

	/**
	 * Handle the request
	 */
	$application = new \Phalcon\Mvc\Application();
	$application->setDI($di);
	echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
} catch (PDOException $e){
	echo $e->getMessage();
}