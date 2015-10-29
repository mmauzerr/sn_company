<?php namespace common\models;


class MainGallery extends Content
{

    public function rules()
    {
        return [
            [['parent_id', 'created_by', 'create_time', 'updated_by', 'update_time', 'status', 'type'], 'integer'],
            [['title', 'excerpt', 'content', 'created_by', 'status' ], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['excerpt'], 'string', 'max' => 255],
            [['status'],'checkGallery'],
        ];
    }

    public static function find()
    {
        return parent::find()->where('type = 1');
    }

    public function checkGallery($attribute, $params){
        $model = MainGallery::find()->where(['type'=>1,'status'=>1])->one();

        if(count($model) == 1 && $this->status == 1){
            $this->addError($attribute,'Mozete imati samo jednu aktivnu galeriju');
            return false;
        }else{
            return true;
        }

    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->type = 1;
            $this->updated_by = \Yii::$app->user->identity->id;
            return true;
        } else {
            return false;
        }
    }

    public function getGalleryItems()
    {

       return $this->hasMany(MainGalleryItems::className(),['parent_id'=>'id']);
    }


}