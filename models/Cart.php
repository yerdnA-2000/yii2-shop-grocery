<?php

namespace app\models;

use yii\base\Model;

/**
 * Model as shopping cart
 * @var array $_SESSION['cart'] the shopping cart
 * @var int $_SESSION['cart.gty'] total quantity of the products
 * @var numeric $_SESSION['cart.sum'] total cost of the products in the cart
 * @extends Model
 */
class Cart extends Model
{

    /**
     * Adds the product to the cart using the session
     * @param Product $product
     * @param int $qty quantity of products, default = 1
     * @return void
     */
    public function addToCart(Product $product, int $qty = 1)
    {
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'title' => $product->title,
                'price' => $product->price,
                'img' => $product->img,
                'qty' => $qty,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty'])
            ? $_SESSION['cart.qty'] + $qty
            : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum'])
            ? $_SESSION['cart.sum'] + $qty * $product->price
            : $qty * $product->price;

    }

}