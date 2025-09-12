<?php

use yii\db\Query;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Book $book */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var Query $query */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="book-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render('_search', ['model' => $book]); ?>

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);


    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'label' => 'Name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data['name'], Url::toRoute(['signup', 'id' => $data['id']]));
                },
            ],
            'books_written',
        ],
    ]);
?>

    <?php ActiveForm::end(); ?>


</div>
