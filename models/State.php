<?php
namespace app\models;

use yii\base\Model;

class State extends Model
{

    const DELETE = -1;
    const NONE   = 0;
    const ALL    = 1;
    const CAT    = 2;

    public $id;
    public $name;

    public static $index = [
        self::DELETE,
        self::NONE,
        self::ALL,
        self::CAT
    ];

    public static $list = [
        self::DELETE  => 'delete',
        self::NONE   => 'none',
        self::ALL     => 'all',
        self::CAT     => 'cat'
    ];

    public static function findOne($id)
    {
        $state = new static();
        $state->id = $id;
        $state->name = self::$list[$id];
        return $state;
    }

}