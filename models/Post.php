<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $scontent
 * @property string $fcontent
 * @property string $create_time
 * @property string $update_time
 * @property integer $category_id
 * @property integer $block_id
 * @property integer $state_id
 * @property integer $lang
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content', 'scontent', 'fcontent'], 'string'],
            [['category_id', 'category_id', 'create_time', 'update_time', 'block_id', 'state_id', 'lang'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'scontent' => 'sContent',
            'fcontent' => 'fContent',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'category_id' => 'Category ID',
            'state_id' => 'State ID',
            'block_id' => 'Block ID',
            'lang' => 'Language'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getBlock()
    {
        return $this->hasOne(Block::className(), ['id' => 'block_id']);
    }

    public function getState()
    {
        return State::findOne($this->state_id);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $this->isNewRecord ? $this->create_time = time() : $this->update_time = time();

            return true;
        }
        return false;
    }
}
