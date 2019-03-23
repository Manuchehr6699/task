<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskSentence */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-sentence-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text_id')->textInput() ?>

    <?= $form->field($model, 'senctence')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_block')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
