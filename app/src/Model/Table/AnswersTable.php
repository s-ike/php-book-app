<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * Class AnswersTable
 * @package App\Model\Table
 */
class AnswersTable extends Table
{
    /**
     * @inheritDoc
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('answers');    // 使用されるテーブル名
        $this->setDisplayField('id');   // list形式でデータを取得する際に使用されるカラム名
        $this->setPrimaryKey('id');     // プライマリーキー

        $this->addBehavior('Timestamp'); // created & modified カラムを自動設定

        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
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
            ->scalar('body', '回答内容が不正です')
            ->requirePresence('body', 'create', '回答内容が不正です')
            ->notEmpty('body', '回答内容は必ず入力してください')
            ->maxLength('body', 140, '回答内容は140文字以内で入力してください');

        return $validator;
    }

    /**
     * ルールチェッカーを作成する
     *
     * @param RulesChecker $rules ルールチェッカーのオブジェクト
     * @return RulesChecker ルールチェッカーのオブジェクト
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(
            ['question_id'],
            'Questions',
            '質問がすでに削除されているため回答できません'
        ));

        return $rules;
    }
}
