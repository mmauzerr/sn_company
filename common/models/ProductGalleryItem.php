<?php
/**
 * Created by PhpStorm.
 * User: Milos Barlov <mbarlov> milosbarlov@gmail.com
 * Date: 16.7.15. \
 * Time: 20.05
 */

namespace common\models;


class ProductGalleryItem extends  Content
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'content' => 'Image max height 700px and width 800px',
            'created_by' => 'Created By',
            'create_time' => 'Create Time',
            'updated_by' => 'Updated By',
            'update_time' => 'Update Time',
            'status' => 'Status',
            'type' => 'Type',
        ];
    }

    public static function find()
    {
        return parent::find()->where('type = 5');
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->type = 5;
            $this->updated_by = \Yii::$app->user->identity->id;
            return true;
        } else {
            return false;
        }
    }

}