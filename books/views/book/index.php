<?php

use app\models\Book;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;


$js = <<< JS
    $(document).ready(function() {
        setTimeout(function() {
            $('[role=alert]').fadeOut(5000); 
        }, 0);
    });
    JS;
$this->registerJs($js);


if (Yii::$app->session->hasFlash('notifications')) {
    $notifications = Yii::$app->session->getFlash('notifications');
    foreach ($notifications as $message) {
        echo
            "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                $message 
            </div>"
        ;
    }
//    echo '</div>';
}

?>



<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
//            'author',
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
            //'photo_url:url',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'contentOptions' => ['style' => 'min-width: 75px !important'],
            ],
        ],
    ]); ?>

</div>
