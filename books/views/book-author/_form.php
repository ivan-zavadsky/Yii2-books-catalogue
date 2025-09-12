<?php

use app\models\Author;
use app\models\Book;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BookAuthor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-author-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'id_book')->textInput() ?>
    <?php

        $books = Book::find()->all();
        $booksList = [];
        foreach ($books as $book) {
            $booksList[$book->id] = $book->name;
        }

        echo $form->field($model, 'id_book')
        ->dropDownList($booksList, ['prompt' => 'Select book']);

        $authors = Author::find()->all();
        $authorsList = [];
        foreach ($authors as $author) {
            $authorsList[$author->id] = $author->name;
        }

        echo $form->field($model, 'id_author')
        ->dropDownList($authorsList, ['prompt' => 'Select author']);

    ?>


<!--    --><?php //= $form->field($model, 'id_author')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
