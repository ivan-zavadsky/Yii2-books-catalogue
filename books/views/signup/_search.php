<?php

use app\models\SignupSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BookSearch $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $years */
/** @var SignupSearch $searchModel */

?>

<?php
    if (
        isset(Yii::$app->request->queryParams['Book']['issue_year'])
    )
    {
        $model->issue_year = Yii::$app->request->queryParams['Book']['issue_year'];
    }
?>
<div class="book-search">

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    ?>

        <?=
        $form->field($model, 'issue_year')
            ->dropDownList($years/*, ['prompt' => 'Select year']*/)
        ?>

        <div class="form-group">
            <?= Html::submitButton('Select', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
