<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $excerpt
 * @property string $content
 * @property integer $created_by
 * @property integer $create_time
 * @property integer $updated_by
 * @property integer $update_time
 * @property integer $status
 * @property integer $type
 */
class Content extends ActiveRecord
{
    const PAGES = 0;
    const MAIN_GALLERY = 1;
    const MAIN_GALLERY_ITEMS = 2;
    const ABOUT_US = 3;
    const PRODUCT_GALLERY = 4;
    const PRODUCT_GALLERY_ITEM = 5;
    const CONTACT = 6;
    const PARTNER = 7;
    const HISTORY = 8;
    const SERVICING = 9;


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
                'value' => function(){
                    return time();
                }
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'created_by', 'create_time', 'updated_by', 'update_time', 'status', 'type'], 'integer'],
            [['title', 'excerpt', 'content', 'created_by', 'status' ], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['excerpt'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'content' => 'Content',
            'created_by' => 'Created By',
            'create_time' => 'Create Time',
            'updated_by' => 'Updated By',
            'update_time' => 'Update Time',
            'status' => 'Status',
            'type' => 'Type',
        ];
    }
    public static function getStatus(){
        return[
          1=>'Active',
          0=>'Delete'
        ];
    }



}