<?php

try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();

} catch(\Phalcon\Exception $e) {
     echo "1.: ", $e->getMessage();
}

try {
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

} catch(\Phalcon\Exception $e) {
     echo "2.: ", $e->getMessage();
}

try {
    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();

} catch(\Phalcon\Exception $e) {
     echo "3.: ", $e->getMessage();
}

try {
    // DB設定
    $di->set('db', function() {
    	return new \Phalcon\Db\Adapter\Pdo\Sqlite(array(
				'dbname' => 'db/test.sqlite3'
			));
		});

} catch(\Phalcon\Exception $e) {
     echo "4.: ", $e->getMessage();
}

try {
		// BaseURI設定
		$di->set('url', function(){
		    $url = new Phalcon\Mvc\Url();
		    $url->setBaseUri('/Phalcon/');
		    return $url;
		});

} catch(\Phalcon\Exception $e) {
     echo "5.: ", $e->getMessage();
}

try {
    //Setting up the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

} catch(\Phalcon\Exception $e) {
     echo "6.: ", $e->getMessage();
}

try {
    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);

} catch(\Phalcon\Exception $e) {
     echo "7.: ", $e->getMessage();
}

try {
    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
/*
try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();

    // DB設定
    $di->set('db', function() {
    	return new \Phalcon\Db\Adapter\Pdo\Sqlite(array(
				'dbname' => 'db/test.sqlite3'
			));
		});

		// BaseURI設定
		$di->set('url', function(){
		    $url = new Phalcon\Mvc\Url();
		    $url->setBaseUri('/Phalcon/');
		    return $url;
		});

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
}*/