<?php

use yii\db\Migration;

class m180706_211611_add_publish_column_to_postcalc_light_countries extends Migration
{
    public function up()
    {
        $this->addColumn( '{{%postcalc_light_countries}}', 'publish', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%postcalc_light_countries}}', 'publish');
    }


}
