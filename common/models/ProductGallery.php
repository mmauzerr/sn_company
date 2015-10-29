<?php


namespace common\models;


class ProductGallery extends ProductGalleryItem{

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'content' => 'Img URL',
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
        return parent::find()->where('type = 4');
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->type = 4;
            $this->updated_by = \Yii::$app->user->identity->id;
            return true;
        } else {
            return false;
        }
    }

    public function getGalleryItems(){
        return $this->hasMany(ProductGalleryItem::className(),['parent_id'=>'id']);
    }

}