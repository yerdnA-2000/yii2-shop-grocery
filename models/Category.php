<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Model as 'categories' table
 * @property mixed|null $title
 * @property mixed|null $keywords
 * @property mixed|null $description
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