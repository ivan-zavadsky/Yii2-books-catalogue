<?php

namespace app\models;

use yii\data\ArrayDataProvider;
use yii\db\Query;

class SignupSearch
{
    public function rules()
    {
        return [
            [['id', 'name', 'books_written'], 'safe'],
        ];
    }

    public function search($params, $formName = null): ArrayDataProvider
    {
        $query = new Query();
        $year = $params['Book']['issue_year'] ?? 0;

        $query
            ->select([
                'author.name',
                'author.id',
                'COUNT(book.id) AS books_written',
            ])
            ->from('author')
            ->innerJoin('book_author', 'book_author.id_author = author.id')
            ->innerJoin('book', 'book.id = book_author.id_book')
            ->where([
                'issue_year' => $year,
            ])
            ->groupBy('author.id')
            ->orderBy(['books_written' => SORT_DESC])
        ;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->all(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }
}
