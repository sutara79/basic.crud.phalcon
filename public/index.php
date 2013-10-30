<?php

try {
echo __DIR__;
    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '/var/www/web/sutara79-php/htdocs/app/controllers/',
        '/var/www/web/sutara79-php/htdocs/app/models/'
    ))->register();

    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();

    // DB設定
    $di->set('db', function() {
    	return new \Phalcon\Db\Adapter\Pdo\Sqlite(array(
				'dbname' => '/var/www/web/sutara79-php/htdocs/public/db/test.sqlite3'
			));
		});

    //Setting up the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('/var/www/web/sutara79-php/htdocs/app/views/');
        return $view;
    });

    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
