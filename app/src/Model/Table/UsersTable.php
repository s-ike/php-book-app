<?php

namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * Class UsersTable
 * @package App\Model\Table
 */
class UsersTable extends Table
{
    /**
     * @inheritDoc
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }
}
