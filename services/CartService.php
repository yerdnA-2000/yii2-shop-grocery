<?php

namespace app\services;

use app\models\Cart;
use app\models\Product;
use yii\web\NotFoundHttpException;
use yii\web\View;

class CartService extends AppService
{
    /**
     * @param int $id id of a product
     * @return array|false
     */
    public function addProductToCart(int $id)
    {
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);
        return compact('session');
    }

}