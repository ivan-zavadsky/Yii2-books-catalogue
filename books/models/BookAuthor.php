<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "book_author".
 *
 * @property int $id_book
 * @property int $id_author
 */
class BookAuthor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_book', 'id_author'], 'required'],
            [['id_book', 'id_author'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_book' => 'Id Book',
            'id_author' => 'Id Author',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BookAuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookAuthorQuery(get_called_class());
    }

    public function getBook(): ActiveQuery
    {
        return $this->hasOne(Book::class, ['id' => 'id_book']);
    }
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'id_author']);
    }
}
