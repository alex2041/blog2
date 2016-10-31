<?php
namespace app\models;

use yii\base\Model;

class Language extends Model
{

    const EN = 1;
    const RU = 2;

    public $id;
    public $name;

    public static $index = [
        self::EN,
        self::RU,
    ];

    public static $list = [
        self::EN  => 'en',
        self::RU   => 'ru',
    ];

    public static function findOne($id)
    {
        $state = new static();
        $state->id = $id;
        $state->name = self::$list[$id];
        return $state;
    }

}