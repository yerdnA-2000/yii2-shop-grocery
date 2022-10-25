<?php

/**
 * This VIEW shows checkout
 * @var yii\web\View $this
 * @var yii\web\Session $session
 * @var app\models\Order $order
 */

?>
<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i><a
                        href="<?= \yii\helpers\Url::home() ?>">Домой</a><span>|</span></li>
            <li>Оформление заказа</li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar') ?>

    <div class="w3l_banner_nav_right">
        <!-- about -->
        <div class="privacy about">
            <?= \app\widgets\Alert::widget(); ?>
            <h3>Оформление <span>заказа</span></h3>
            <?php if (!empty($session['cart'])): ?>
                <div class="checkout-right">
                    <h4>Товаров в вашей корзине: <span style="margin-left: 1rem;"><?= $session['cart.qty'] ?></span>
                    </h4>
                    <div class="cart-table">
                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <table class="timetable_sub">
                            <thead>
                            <tr>
                                <th>П/Н</th>
                                <th>Товар</th>
                                <th>Количество</th>
                                <th>Наименование</th>
                                <th>Цена</th>
                                <th>Удаление</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php $i = 1;
                                foreach ($session['cart'] as $id => $item): ?>
                                <td class="invert"><?= $i ?></td>
                                <td class="invert-image">
                                    <a href="<?= \yii\helpers\Url::to(['product/show', 'id' => $id]) ?>">
                                        <?= \yii\helpers\Html::img("@web/images/products/{$item['img']}",
                                            ['alt' => $item['title']]) ?>
                                    </a>
                                </td>
                                <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <div class="entry value-minus" data-qty="-1" data-id="<?= $id ?>">&nbsp;
                                            </div>
                                            <div class="entry value"><span><?= $item['qty'] ?></span></div>
                                            <div class="entry value-plus active" data-qty="1" data-id="<?= $id ?>">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert"><?= $item['title'] ?></td>
                                <td class="invert">$<?= $item['price'] ?></td>
                                <td class="invert">
                                    <div class="rem">
                                        <a class="close1"
                                           href="<?= \yii\helpers\Url::to(['cart/delete-item', 'id' => $id]) ?>"></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++;
                            endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="checkout-left">
                    <div class="col-md-4 checkout-left-basket">
                        <h4>Итого в корзине</h4>
                        <ul>
                            <?php foreach ($session['cart'] as $item): ?>
                                <li><?= $item['title'] ?> <i>-</i> <span>$<?= $item['price'] * $item['qty'] ?> </span>
                                </li>
                            <?php endforeach; ?>
                            <li>Стоимость <i>-</i> <span>$<?= $session['cart.sum'] ?></span></li>
                        </ul>
                    </div>
                    <div class="col-md-8 address_form_agile">
                        <h4>Данные покупателя</h4>
                        <?php $form = \yii\widgets\ActiveForm::begin() ?>
                        <?= $form->field($order, 'name'); ?>
                        <?= $form->field($order, 'email'); ?>
                        <?= $form->field($order, 'phone'); ?>
                        <?= $form->field($order, 'address'); ?>
                        <?= $form->field($order, 'note'); ?>
                        <?= \yii\helpers\Html::submitButton('Заказать', ['class' => 'submit check_out']); ?>
                        <?php \yii\widgets\ActiveForm::end(); ?>
                    </div>

                    <div class="clearfix"></div>

                </div>
            <?php else: ?>
                <h3>Ваша корзина пуста</h3>
            <?php endif; ?>
        </div>
        <!-- //about -->
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->

