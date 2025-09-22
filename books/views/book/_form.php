<?php

use app\models\Author;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var app\models\Author $author */
/** @var app\models\Author[] $authors */
/** @var yii\widgets\ActiveForm $form */


//$url = 'create&a=b';
$url = Url::to(['author/create'], false);

//echo '<pre>';
//var_dump(
//        $url
//);
//echo '</pre>';
//die;

?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($author, 'name')
            ->dropDownList(
//                $authors,
                ArrayHelper::map(Author::find()->orderBy('name')->all(), 'id', 'name'),
                [
                    'name' => 'Author[id]',
                    'multiple' => true,
                ]
            )
            ->label('Author(s)')
        ?>

        <p>
<!--            --><?php //= Html::a('Add author', [$url], ['class' => 'btn btn-success']) ?>
            <?php
                echo '<a href="' . $url . '" class="btn btn-success">Create author</a>';
            ?>
        </p>

    <?= $form->field($model, 'issue_year')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo_url')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
