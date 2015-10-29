<?php
/**
 * Created by PhpStorm.
 * User: Milos Barlov <mbarlov> milosbarlov@gmail.com
 * Date: 15.7.15. \
 * Time: 13.34
 */

namespace common\models;


class MainGalleryItems extends Content
{
    public static function find()
    {
        return parent::find()->where('type = 2');
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'content' => 'Image max height 500px',
            'created_by' => 'Created By',
            'create_time' => 'Create Time',
            'updated_by' => 'Updated By',
            'update_time' => 'Update Time',
            'status' => 'Status',
            'type' => 'Type',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->type = 2;
            $this->updated_by = \Yii::$app->user->identity->id;
            return true;
        } else {
            return false;
        }
    }
}