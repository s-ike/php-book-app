<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class QuestionsTable
 * @package App\Model\Table
 */
class QuestionsTable extends Table
{
    /**
     * @inheritDoc
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('questions');  // 使用されるテーブル名
        $this->setDisplayField('id');   // list形式でデータを取得する際に使用されるカラム名
        $this->setPrimaryKey('id');     // プライマリーキー

        $this->addBehavior('Timestamp'); // cretaed & modified 自動設定

        $this->hasMany('Answers', [
            'foreignKey' => 'question_id'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * 回答付きの質問一覧を取得する
     *
     * @return \Cake\ORM\Query 回答付きの質問一覧クエリ
     */
    public function findQuestionWithAnsweredCount()
    {
        $query = $this->find();
        $query
            ->select(['answered_count' => $query->func()->count('Answers.id')])
            ->leftJoinWith('Answers')
            ->group(['Questions.id'])
            ->enableAutoFields(true);

        return $query;
    }

    /**
     * バリデーションルールの定義
     *
     * @param Validator $validator バリデーションインスタンス
     * @return Validator バリデーションインスタンス
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id', 'IDが不正です')
            ->allowEmpty('id', 'IDが不正です');

        $validator
            ->scalar('body', '質問内容が不正です')
            ->requirePresence('body', 'create', '質問内容が不正です')
            ->notEmpty('body', '質問内容は必ず入力してください')
            ->maxLength('body', 140, '質問内容は140文字以内で入力してください');

        return $validator;
    }
}
