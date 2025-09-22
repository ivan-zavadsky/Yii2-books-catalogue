<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ReportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Report';
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            [
                'label' => 'Authors',
                'value' => function ($model) {
                    return $model->getAuthorsList();
                }
            ],
            'issue_year',
            [
                'label' => 'Description',
                'value' => function($model) {
                    $description = strlen((string) $model->description)
                        ? substr($model->description, 0, 20) . '...'
                        : '<span class="not-set">(not set)</span>';
                    return $description;
                },
                'format' => 'raw',
                'contentOptions' => ['style' => 'text-align: center;'],
            ],
            'isbn',
            'photo_url:url',
        ],
    ]); ?>


</div>
