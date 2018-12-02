<?php

use yii\db\Migration;

/**
 * Handles adding password to table `users`.
 */
class m181122_181107_add_password_column_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'password', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'password');
    }
}
