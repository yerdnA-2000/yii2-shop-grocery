<?php

namespace app\services;

use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;
use yii\web\View;

class CartService extends AppService
{
    /**
     * Adds the product to the cart using the session
     * @param int $id id of a product
     * @var \yii\web\Session $session
     * @var \app\models\Product $product
     * @var \app\models\Cart $cart
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

    /**
     * @param int $id
     * @var \yii\web\Session $session
     * @var \app\models\Cart $cart
     * @return array
     */
    public function deleteItem(int $id): array
    {
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->refresh($id);
        return compact('session');
    }

    /**
     * @var \yii\web\Session $session
     * @return array
     */
    public function clear(): array
    {
        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        return compact('session');
    }

    /**
     * @param \yii\web\View $view
     * @var \yii\web\Session $session
     * @return array|bool
     */
    public function checkout(View $view)
    {
        /*$session = \Yii::$app->session;
        $this->setMeta($view, "Оформление заказа | " . \Yii::$app->name);
        $order = new Order();
        $orderProduct = new OrderProduct();
        if ($order->load(\Yii::$app->request->post())) {
            $order->qty = \Yii::$app->session['cart.qty'];
            $order->total = \Yii::$app->session['cart.sum'];
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if (!$order->save() || !$orderProduct->saveOrderProducts($session['cart'], $order->id)) {
                \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
                $transaction->rollBack();
            } else {
                $transaction->commit();
                \Yii::$app->session->setFlash('success', 'Ваш заказ принят');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return [];
            }
        }
        return compact('session', 'order', 'orderProduct');*/
    }

    /**
     * @param int $id
     * @param int $qty
     * @var \yii\web\Session $session
     * @var \app\models\Product $product
     * @var \app\models\Cart $cart
     * @return array|false
     */
    public function change(int $id, int $qty)
    {
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        return compact('session');
    }

}