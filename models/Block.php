<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property integer $id
 * @property string $name
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['block_id' => 'id']);
    }
}
