<?php

use yii\db\Migration;

/**
 * Class m230806_071431_create_currency
 */
class m230806_071431_create_currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'code' => $this->string(3)->notNull(),
            'date' => $this->date()->notNull(),
            'rate' => $this->decimal(10, 4),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('currency');
    }
}
