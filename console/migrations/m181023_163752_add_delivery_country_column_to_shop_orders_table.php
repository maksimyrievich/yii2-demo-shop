<?php

use yii\db\Migration;

/**
 * Handles adding delivery_country to table `shop_orders`.
 */
class m181023_163752_add_delivery_country_column_to_shop_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_orders', 'delivery_country', $this->string());
        $this->addColumn('shop_orders', 'delivery_town', $this->string());
        $this->addColumn('shop_orders', 'delivery_street', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_orders', 'delivery_country');
        $this->dropColumn('shop_orders', 'delivery_town');
        $this->dropColumn('shop_orders', 'delivery_street');
    }
}
