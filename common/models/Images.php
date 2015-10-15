<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $photo
 * @property integer $created_at
 *
 * @property Category $category
 * @property Product[] $products
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'photo', 'created_at'], 'required'],
            [['category_id', 'created_at'], 'integer'],
            [['photo'], 'string', 'max' => 255]
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
            'photo' => 'Photo',
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
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['images_id' => 'id']);
    }
}
