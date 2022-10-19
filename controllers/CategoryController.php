<?php

namespace app\controllers;

use app\components\data\CustomPagination;
use app\models\Product;
use app\services\CategoryService;
use yii\web\NotFoundHttpException;

class CategoryController extends AppController
{
    /**
     * @var CategoryService $service
     */
    public CategoryService $service;

    public function __construct($id, $module, CategoryService $_service, $config = [])
    {
        //debug([$id, $module, $config]);
        $this->service = $_service;
        parent::__construct($id, $module, $_service, $config);
    }

    /**
     * Display view show category with products
     * @param int $id category id value
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionShow(int $id): string
    {
        $showData = $this->service->getShowData($id, $this->view);

        return $this->render('show', $showData);
    }

    public function actionSearch()
    {
        $q = trim(\Yii::$app->request->get('q'));
        if (empty($q)) {
            return $this->render('search');
        }
        $searchResultData = $this->service->getSearchResultData($q);

        return $this->render('search', $searchResultData);
    }
}