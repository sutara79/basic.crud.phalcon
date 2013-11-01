<?php
/**
 * entriesコントローラ
 */
class EntriesController extends \Phalcon\Mvc\Controller {

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// ホーム
	public function indexAction() {
		$this->view->setVar('rows', Entries::find());
	}

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// 1件を詳細表示
	public function viewAction($id) {
		$this->view->setVar('row', Entries::findFirst($id));
	}

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// 新規登録
	public function insertAction() {
		// フォーム送信後
		if ($data = $this->request->getPost()) {
			// モデルのクラスを読み込む
			$entries = new Entries();

			$data['created'] = $data['modified'] = date('Y-m-d h:i:s');
			// INSERT文になるよう、主キー(id)を指定しない
			$entries->save($data, array('name', 'body', 'created', 'modified'));

			// リダイレクト
			$this->dispatcher->forward(array(
				'controller' => 'entries',
				'action'     => 'index'
			));
		// 初期画面
		} else {
			$this->view->setVar('row', Entries::findFirst($id));
		}
	}

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// 編集
	public function editAction($id) {
		// フォーム送信後
		if ($data = $this->request->getPost()) {
			// モデルのクラスを読み込む
			$entries = new Entries();

			$data['modified'] = date('Y-m-d h:i:s');
			// UPDATE文になるよう、主キー(id)を指定する
			$entries->save($data, array('id', 'name', 'body', 'modified'));

			// リダイレクト
			$this->dispatcher->forward(array(
				'controller' => 'entries',
				'action'     => 'index'
			));
		// 初期画面
		} else {
			$this->view->setVar('row', Entries::findFirst($id));
		}
	}

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// 削除
	public function deleteAction($id) {
		$entry = Entries::findFirst($id);
		$entry->delete();

		// リダイレクト
		$this->dispatcher->forward(array(
			'controller' => 'entries',
			'action'     => 'index'
		));
	}
}
