<?php
/**
 * entriesコントローラ
 */
class entriesController extends \Phalcon\Mvc\Controller {

	public function indexAction() {
		$entries = new Entries();
		$this->view->setVar('rows', $entries->find());
	}
	
	public function viewAction($id) {
		$entries = new Entries();
		$this->view->setVar('row', $entries->findFirst($id));
	}
}
