<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;
use app\services\CartService;
use yii\web\Session;

class CartController extends AppController
{
    /**
     * @var CartService $service
     */
    public CartService $service;

    public function __construct($id, $module, CartService $_service, $config = [])
    {
        $this->service = $_service;
        parent::__construct($id, $module, $_service, $config);
    }

    /**
     * Adds the product to the cart
     * @param int $id
     * @var array $dataResponse
     * @return false|string|\yii\web\Response
     */
    public function actionAdd(int $id)
    {
        $dataResponse = $this->service->addProductToCart($id);
        if (!$dataResponse) {
            return false;
        }
        //Если запрос пришел с ajax, то отдаем вид без шаблона, иначе отдаем ту же страницу, откуда был отправлен запрос
        if (\Yii::$app->request->isAjax) {
            return $this->renderPartial('cart_modal', $dataResponse);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Displays the shopping
     * @var Session $session
     * @return string
     */
    public function actionPreview(): string
    {
        $session = \Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart_modal', compact('session'));
    }

    /**
     * Deletes cart item
     * @param int $id
     * @var array $dataResponse
     * @return string|\yii\web\Response
     */
    public function actionDeleteItem(int $id)
    {
        $dataResponse = $this->service->deleteItem($id);
        if (\Yii::$app->request->isAjax) {
            return $this->renderPartial('cart_modal', $dataResponse);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Clears cart
     * @var array $dataResponse
     * @return string
     */
    public function actionClear(): string
    {
        $dataResponse = $this->service->clear();
        return $this->renderPartial('cart_modal', $dataResponse);
    }

    /**
     * Displays checkout form
     * @return string|\yii\web\Response
     * @var array $dataResponse
     * @var \yii\web\Session $session
     */
    public function actionCheckout()
    {
        $this->setMeta("Оформление заказа :: " . \Yii::$app->name);
        $session = \Yii::$app->session;
        $order = new Order();
        $order_product = new OrderProduct();
        if($order->load(\Yii::$app->request->post())){
            $order->qty = $session['cart.qty'];
            $order->total = $session['cart.sum'];
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if(!$order->save() || !$order_product->saveOrderProducts($session['cart'], $order->id)){
                \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
                $transaction->rollBack();
            }else{
                $transaction->commit();
                \Yii::$app->session->setFlash('success', 'Ваш заказ принят');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }
        }
        return $this->render('checkout', compact('session', 'order', 'order_product'));
    }

    /**
     * @param int $id
     * @param int $qty
     * @var array $dataResponse
     * @return false|string
     */
    public function actionChange(int $id, int $qty)
    {
        $dataResponse = $this->service->change($id, $qty);
        if (!$dataResponse) {
            return false;
        }
        return $this->renderPartial('cart_modal', $dataResponse);
    }

}