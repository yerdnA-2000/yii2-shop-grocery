<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Model as 'order_product' table
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $title
 * @property int(tinyint) $qty
 * @property numeric(decimal-6,2) $price
 * @property numeric(decimal-6,2) $total
 * @extends ActiveRecord
 */
class OrderProduct extends ActiveRecord
{

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'order_product';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['order_id', 'product_id', 'title', 'price', 'qty', 'total'], 'required'],
            [['order_id', 'product_id', 'qty'], 'integer'],
            [['price', 'total'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function saveOrderProducts($products, $orderId)
    {
        foreach ($products as $id => $product) {
            $this->id = null;
            $this->isNewRecord = true;
            $this->order_id = $orderId;
            $this->product_id = $id;
            $this->title = $product['title'];
            $this->price = $product['price'];
            $this->qty = $product['qty'];
            $this->total = $product['qty'] * $product['qty'];
            if (!$this->save()) {
                return false;
            }
            return true;
        }
    }

}