<?php

use yii\db\Migration;

class m250920_154254_create_contact_table_with_link extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'type' => $this->string(256)->notNull(),
            'guest_token' => $this->string(256)->notNull(),
        ]);

        $this->createTable('contact_author', [
            'id_contact' => $this->integer()->notNull(),
            'id_author' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('contact_author');
        $this->dropTable('contact');
    }
}
