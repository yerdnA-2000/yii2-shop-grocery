<?php

namespace app\controllers;

use app\services\CartService;

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
     * @return false|string|\yii\web\Response
     */
    public function actionAdd(int $id)
    {
        $cartData = $this->service->addProductToCart($id);
        if (!$cartData) {
            return false;
        }
        //Если запрос пришел с ajax, то отдаем вид без шаблона, иначе отдаем ту же страницу, откуда был отправлен запрос
        if (\Yii::$app->request->isAjax) {
            return $this->renderPartial('cart_modal', $cartData);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Displays the shopping cart
     * @return string
     */
    public function actionShow(): string
    {
        $session = \Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart_modal', compact('session'));
        
    }

}