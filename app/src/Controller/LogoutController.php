<?php

namespace App\Controller;


class LogoutController extends AppController
{
    /**
     * @inheritDoc
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->deny(['index']);
    }

    /**
     * ログアウト処理
     *
     * @return \Cake\Http\Response|null ログアウト後にログインTOPに遷移する
     */
    public function index()
    {
        $this->Flash->success('ログアウトしました');
        return $this->redirect($this->Auth->logout());
    }
}
