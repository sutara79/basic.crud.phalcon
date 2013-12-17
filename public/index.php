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
			'dbname' => '../app/db/test.sqlite3'
		));
	});

	//Setting up the view component
	$di->set('view', function(){
		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir('../app/views/');
		return $view;
	});

	// BaseURI設定
	// 必須の設定ではありませんが、
	// ドキュメントルートからPhalconアプリまでのパスが
	// 環境によって異なる場合は指定しなければなりません。
	// (例)
	// 本番(ドキュメントルート直下): http://foo.com/
	// ローカル(サブフォルダの中): http://localhost/bar/
	$di->set('url', function(){
		$url = new Phalcon\Mvc\Url();
		if (preg_match('/Phalcon/', __DIR__)) {
			$url->setBaseUri('/Phalcon/');
		}
		return $url;
	});

	//Handle the request
	$application = new \Phalcon\Mvc\Application($di);

	echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
	echo "PhalconException: ", $e->getMessage();
}
