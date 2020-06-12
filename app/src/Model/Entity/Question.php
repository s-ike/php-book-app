<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Question
 * @package App\Model\Entity
 */
class Question extends Entity
{
    protected $_accessible = [
        'user_id'   => true,
        'body'      => true,
        'created'   => true,
        'modified'  => true
    ];
}
