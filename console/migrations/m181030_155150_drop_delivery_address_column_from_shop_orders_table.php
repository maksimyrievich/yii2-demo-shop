<?php

use yii\db\Migration;

/**
 * Handles dropping delivery_address from table `shop_orders`.
 */
class m181030_155150_drop_delivery_address_column_from_shop_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('shop_orders', 'delivery_address');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('shop_orders', 'delivery_address', $this->text());
    }
}
