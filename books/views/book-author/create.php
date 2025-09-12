<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BookAuthor $model */

$this->title = 'Create Book Author';
$this->params['breadcrumbs'][] = ['label' => 'Book Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
