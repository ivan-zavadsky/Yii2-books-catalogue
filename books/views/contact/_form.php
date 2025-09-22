<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contact $model */
/** @var yii\widgets\ActiveForm $form */
/** @var string $token */

$model->guest_token = $token;
$model->type = 1;
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')
        ->dropDownList(
            ['phone', 'email'],
            ['style' => 'display:none']
        )
        ->label(false)
    ?>

    <?= $form->field($model, 'name')
        ->textInput(['maxlength' => true])
        ->label('Enter email')
    ?>

        <?= $form->field($model, 'guest_token')
            ->textInput([
                'maxlength' => true,
                'style' => 'display:none',
            ])->label(false)
        ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
