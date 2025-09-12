<?php

namespace app\controllers;

use app\models\Book;
use app\models\SignupSearch;
use yii\web\Controller;

class SignupController extends Controller
{
    public function actionIndex()
    {

        $book = new Book();
        $searchModel = new SignupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'book' => $book,
        ]);
    }

}