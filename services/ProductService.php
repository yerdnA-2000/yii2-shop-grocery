<?php

namespace app\services;

use app\components\data\CustomPagination;
use app\models\Product;
use yii\web\NotFoundHttpException;
use yii\web\View;

class ProductService extends AppService
{
    /**
     * @param int $id
     * @param View $view
     * @return array
     * @throws NotFoundHttpException
     */
    public function getShowData(int $id, View $view): array
    {
        $product = Product::findOne($id);
        if (empty($product)) {
            throw new NotFoundHttpException('Такого продукта не существует');
        }
        $this->setMeta(
            $view,
            "{$product->title} | " . \Yii::$app->name,
            $product->keywords,
            $product->description
        );
        return compact('product');
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