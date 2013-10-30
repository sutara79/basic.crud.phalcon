<?php

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
}
