<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Model as 'products' table
 * @extends ActiveRecord
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }
}