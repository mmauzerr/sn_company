<?php
/**
 * Created by PhpStorm.
 * User: Milos Barlov <mbarlov> milosbarlov@gmail.com
 * Date: 16.7.15. \
 * Time: 20.57
 */

namespace common\models;


class Contact extends Content
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Address',
            'excerpt' => 'FB URL',
            'content' => 'Telephone',
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
        return parent::find()->where('type = 6');
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->type = 6;
            $this->updated_by = \Yii::$app->user->identity->id;
            return true;
        } else {
            return false;
        }
    }

}