<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class CategoryController extends AppController
{

    /**
     * Display view show category with products
     * @param int $id category id value
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionShow(int $id): string
    {
        $category = Category::findOne($id);
        if (empty($category)) {
            throw new NotFoundHttpException('Такой категории не существует, либо она была перемещена.');
        }
        $this->setMeta(
            "{$category->title} | " . \Yii::$app->name,
            $category->keywords,
            $category->description
        );
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 4,
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('show', compact(
            'category', 'products', 'pages'
        ));
    }
}