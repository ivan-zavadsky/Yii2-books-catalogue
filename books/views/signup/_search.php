<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BookSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-search">

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);

    $years = [];
    $books = $model::find()->all();
    foreach ($books as $key => $book) {
        $years[$book->issue_year] = $book->issue_year;
    }
    ?>

    <?=
    $form->field($model, 'issue_year')
        ->dropDownList($years, ['prompt' => 'Select year'])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Select', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
