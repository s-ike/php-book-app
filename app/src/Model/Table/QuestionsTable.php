<?php

namespace App\Model\Table;

use Cake\ORM\Table;

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
    }
}
