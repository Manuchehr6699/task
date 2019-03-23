<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskSentenceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-sentence-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sentence_id') ?>

    <?= $form->field($model, 'text_id') ?>

    <?= $form->field($model, 'senctence') ?>

    <?= $form->field($model, 'is_block') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
