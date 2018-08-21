<?php

use yii\db\Migration;

/**
 * Handles adding parent_id to table `shop_categories`.
 */
class m180806_195047_add_parent_id_column_to_shop_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_categories', 'parent_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_categories', 'parent_id');
    }
}
