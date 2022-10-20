<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Model as 'products' table
 * @property int|null $id
 * @property string|null $title
 * @property string|null $keywords
 * @property string|null $description
 * @property \yii\db\ActiveQuery $category virtual property
 * @property numeric|null $price
 * @property string|null $img
 * @extends ActiveRecord
 */
class Product extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'products';
    }

    /**
     * Many-to-One relationship
     * @return \yii\db\ActiveQuery
     */
    public function getCategory(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

}