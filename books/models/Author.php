<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 */
class Author extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(
            Book::class,
            ['id' => 'id_book']
        )->viaTable(
            'book_author',
            ['id_author' => 'id']
        );
    }

    /**
     * {@inheritdoc}
     * @return AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorQuery(get_called_class());
    }

    public function getBooksNumber($year): int
    {
        $books = (new Query())
            ->select(['author.name'])
            ->from('author')
            ->innerJoin('book_author', 'book_author.id_author = author.id')
            ->innerJoin('book', 'book.id = book_author.id_book')
            ->where([
                'author.id' => $this->id,
            ])
            ->andWhere([
                'issue_Year' => $year,
            ])
            ->count()
        ;

        return $books;
    }
}
