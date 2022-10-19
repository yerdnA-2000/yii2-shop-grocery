<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Model as 'categories' table
 * @extends ActiveRecord
 */
class Category extends ActiveRecord
{

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'categories';
    }

}