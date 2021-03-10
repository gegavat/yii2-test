<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m210310_183609_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'fallen_at' => $this->integer(11)->defaultValue(null),
            'residue' => $this->integer(11)->defaultValue(100),
        ]);
        $this->addColumn('{{%apple}}', 'status', "enum('on_tree','on_ground', 'spoiled') COLLATE utf8_general_ci DEFAULT 'on_tree' NOT NULL AFTER `fallen_at`");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
