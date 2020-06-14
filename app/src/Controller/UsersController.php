<?php

namespace App\Controller;

/**
 * Class UsersController
 * @package App\Controller
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * @inheritDoc
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['add']);
    }

    /**
     * ユーザー登録画面/ユーザー登録処理
     *
     * @return \Cake\Http\Response|null ユーザー登録後にログイン画面へ遷移する
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('ユーザーの登録が完了しました');

                return $this->redirect(['controller' => 'Login', 'action' => 'index']);
            }
            $this->Flash->error('ユーザーの登録に失敗しました');
        }
        $this->set(compact('user'));
    }
}
