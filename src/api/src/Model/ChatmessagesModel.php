<?php

namespace api\Model;

use Depa\Core\DataModel\ActiveRecord\ActiveRecord;

class ChatmessagesModel extends ActiveRecord
{

    public $tablename = 'ChatMessages';

    public $primaryKeys = [
        'id',
    ];

    public $attributes = [
        'id',
        'roomId',
        'message',
        'timestamp',
    ];

    public $rules = [
        [
            'attribute' => 'id',
            'type' => 'required',
        ],
        [
            'attribute' => 'roomId',
            'type' => 'required',
        ],
        [
            'attribute' => 'message',
            'type' => 'required',
        ],
        [
            'attribute' => 'timestamp',
            'type' => 'required',
        ],
    ];

}