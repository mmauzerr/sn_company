<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $images_id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $status
 * @property integer $created_at
 *
 * @property Category $category
 * @property Images $images
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'images_id', 'name', 'created_at'], 'required'],
            [['category_id', 'images_id', 'price', 'status', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'images_id' => 'Images ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasOne(Images::className(), ['id' => 'images_id']);
    }
}
