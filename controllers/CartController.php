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

    public function actionAdd(int $id)
    {
        var_dump($id); die;
    }

}