<?php
/**
 * Created by PhpStorm.
 * User: Milos Barlov <mbarlov> milosbarlov@gmail.com
 * Date: 16.7.15. \
 * Time: 12.02
 */

namespace common\models;


class AboutUs extends Content
{
    public static function find()
    {
        return parent::find()->where('type = 3');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->type = 3;
            $this->updated_by = \Yii::$app->user->identity->id;
            return true;
        } else {
            return false;
        }
    }

}