<?php

try {

	//Register an autoloader
	$loader = new \Phalcon\Loader();

	$loader->registerDirs(array(
		'../app/controllers/',
		'../app/models/'
	))->register();

$url = new Phalcon\Mvc\Url();

echo $url->getBaseUri();
/*

$url = new Phalcon\Mvc\Url();

//Pass the URI in $_GET["_url"]
$url->setBaseUri('/public/index.php?_url=/');

//Pass the URI using $_SERVER["REQUEST_URI"]
$url->setBaseUri('/public/index.php/');

$router = new Phalcon\Mvc\Router();

// ... define routes
$uri = str_replace($_SERVER["SCRIPT_NAME"], '', $_SERVER["REQUEST_URI"]);
$router->handle($uri);

*/


	//Create a DI
	$di = new Phalcon\DI\FactoryDefault();

	// DB設定
	$di->set('db', function() {
		return new \Phalcon\Db\Adapter\Pdo\Sqlite(array(
			'dbname' => 'db/test.sqlite3'
		));
	});
/*
	// BaseURI設定
	$di->set('url', function(){
		$url = new Phalcon\Mvc\Url();
		$url->setBaseUri('/Phalcon/');
		return $url;
	});
*/
	//Setting up the view component
	$di->set('view', function(){
		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir('../app/views/');
		return $view;
	});

	//Handle the request
	$application = new \Phalcon\Mvc\Application($di);

	echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
	 echo "PhalconException: ", $e->getMessage();
}