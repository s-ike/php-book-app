<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Answer
 * @package App\Model\Entity
 */
class Answer extends Entity
{
    protected $_accessible = [
        'question_id' => true,
        'user_id' => true,
        'body' => true,
        'created' => true,
        'modified' => true
    ];
}
