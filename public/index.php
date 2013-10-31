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

try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();

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