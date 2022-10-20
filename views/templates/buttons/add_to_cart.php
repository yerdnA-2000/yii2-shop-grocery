<?php

/**
 * Template button - add to cart
 * @var app\models\Product $product
 * @var app\models\Product $offer
 */

if (isset($offer)) {
    $product = $offer;
}

?>

<a href="<?= \yii\helpers\Url::to([
    'cart/add',
    'id' => $product->id
]) ?>" data-id="<?= $product->id ?>" class="button add-to-cart">
    Add to cart
</a>