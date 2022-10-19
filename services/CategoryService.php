<?php

namespace app\services;

use app\models\Category;
use app\models\Product;
use app\components\data\CustomPagination;
use yii\web\NotFoundHttpException;
use yii\web\View;

class CategoryService extends AppService
{
    /**
     * @param int $id
     * @param View $view
     * @return array
     * @throws NotFoundHttpException
     */
    public function getShowData(int $id, View $view): array
    {
        $category = Category::findOne($id);
        if (empty($category)) {
            throw new NotFoundHttpException('Такой категории не существует, либо она была перемещена.');
        }
        $this->setMeta(
            $view,
            "{$category->title} | " . \Yii::$app->name,
            $category->keywords,
            $category->description
        );
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new CustomPagination([
            'totalCount' => $query->count(),
            'pageSize' => 4,
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return compact('category', 'products', 'pages');
    }

    /**
     * @param string $q
     * @return array
     */
    public function getSearchResultData(string $q): array
    {
        $query = Product::find()->where(['like', 'title', $q]);
        $pages = new CustomPagination([
            'totalCount' => $query->count(),
            'pageSize' => 4,
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return compact('products', 'pages', 'q');
    }
}