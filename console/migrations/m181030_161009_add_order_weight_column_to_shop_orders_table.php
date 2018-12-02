<?php

use yii\db\Migration;

/**
 * Handles adding order_weight to table `shop_orders`.
 */
class m181030_161009_add_order_weight_column_to_shop_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_orders', 'order_weight', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_orders', 'order_weight');
    }
}
