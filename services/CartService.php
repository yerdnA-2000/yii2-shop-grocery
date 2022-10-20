<?php

namespace app\services;

use yii\web\NotFoundHttpException;
use yii\web\View;

class CartService extends AppService
{
    /**
     * @param int $id
     * @param View $view
     * @return array
     * @throws NotFoundHttpException
     */
    public function getShowData(int $id, View $view): array
    {

    }

}