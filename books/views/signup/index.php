<?php

use app\models\SignupSearch;
use yii\db\Query;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Book $book */
/** @var array $years */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var Query $query */
/** @var SignupSearch $searchModel */

$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
$js = <<< JS
    $(document).ready(function() {
        setTimeout(function() {
            $('[role=alert]').fadeOut(3000); 
        }, 0);
    });
    JS;
$this->registerJs($js, View::POS_READY);

?>

<div class="book-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render(
        '_search',
        [
            'model' => $book,
            'years' => $years,
            'searchModel' => $searchModel
        ])
    ;
    ?>

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
