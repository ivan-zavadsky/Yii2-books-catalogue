<?php

use yii\db\Migration;

class m250910_112420_create_book_author_link extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'issue_year' => $this->integer(),
            'description' => $this->text(),
            'isbn' => $this->string(256),
            'photo_url' => $this->string(256),
        ]);

        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
        ]);

        $this->createTable('book_author', [
            'id_book' => $this->integer()->notNull(),
            'id_author' => $this->integer()->notNull(),
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('book_author');
        $this->dropTable('author');
        $this->dropTable('book');
    }

}
