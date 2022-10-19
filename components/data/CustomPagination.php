<?php

namespace app\components\data;

class CustomPagination extends \yii\data\Pagination
{
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->forcePageParam = false;
        $this->pageSizeParam = false;
    }
}