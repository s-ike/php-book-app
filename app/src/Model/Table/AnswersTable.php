<?php

namespace App\Model\Table;

use Cake\ORM\Table;

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
    }
}
