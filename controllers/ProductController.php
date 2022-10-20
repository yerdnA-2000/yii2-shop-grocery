<?php

namespace app\controllers;

use app\services\ProductService;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
    /**
     * @var ProductService $service
     */
    public ProductService $service;

    public function __construct($id, $module, ProductService $_service, $config = [])
    {
        $this->service = $_service;
        parent::__construct($id, $module, $_service, $config);
    }

    /**
     * Displays the view of the product card
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionShow($id): string
    {
        $showData = $this->service->getShowData($id, $this->view);

        return $this->render('show', $showData);
    }
}