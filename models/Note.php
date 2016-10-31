<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "note".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $folder_id
 * @property integer $create_time
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content', 'create_time'], 'string'],
            [['folder_id'], 'integer'],
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
            'content' => 'Content',
            'folder_id' => 'Folder ID',
            'create_time' => 'Create Time',
        ];
    }

    public function getFolder()
    {
        return $this->hasOne(Folder::className(), ['id' => 'folder_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $this->create_time ? $this->create_time = strtotime($this->create_time) : $this->create_time = time();

            return true;
        }
        return false;
    }

    public static function countNoteByFolderId($folder_id){
        $count = Note::find()->where(['folder_id' => $folder_id]);
        return $count->count();
    }
}
