<?php

namespace api\Model;

use Depa\Core\DataModel\ActiveRecord\ActiveRecord;

class ChatroomsModel extends ActiveRecord
{

    public $tablename = 'Chatrooms';

    public $primaryKeys = [
        'id',
        ];

    public $attributes = [
        'id',
        ];

    public $rules = [
        [
            'attribute' => 'id',
            'type' => 'required'
        ],
];
}