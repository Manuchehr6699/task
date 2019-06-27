<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\library\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

<!--    --><?//= $form->field($model, 'flagIzmen') ?>
<!---->
<!--    --><?//= $form->field($model, 'flagIzYak') ?>
<!---->
<!--    --><?//= $form->field($model, 'flagIzAgro') ?>
<!---->
<!--    --><?//= $form->field($model, 'doc_id') ?>
<!---->
<!--    --><?//= $form->field($model, 'doc_num') ?>

    <?php // echo $form->field($model, 'doc_year') ?>

    <?php // echo $form->field($model, 'book_id_start') ?>

    <?php  echo $form->field($model, 'book_naimen_id') ?>

    <?php // echo $form->field($model, 'lot_id') ?>

    <?php // echo $form->field($model, 'book_count') ?>

    <?php  echo $form->field($model, 'naimen') ?>

    <?php  echo $form->field($model, 'book_author') ?>

    <?php // echo $form->field($model, 'izdan') ?>

    <?php // echo $form->field($model, 'soli_nashr') ?>

    <?php  echo $form->field($model, 'nashriyot_id') ?>

    <?php  echo $form->field($model, 'joi_nashr_id') ?>

    <?php // echo $form->field($model, 'count_page') ?>

    <?php  echo $form->field($model, 'book_language_id') ?>

    <?php // echo $form->field($model, 'format') ?>

    <?php // echo $form->field($model, 'ISBN') ?>

    <?php // echo $form->field($model, 'BBK') ?>

    <?php // echo $form->field($model, 'UDK') ?>

    <?php // echo $form->field($model, 'price_now') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'cover_id') ?>

    <?php  echo $form->field($model, 'cat_id') ?>

    <?php  echo $form->field($model, 'seriya_id') ?>

    <?php // echo $form->field($model, 'describe') ?>

    <?php // echo $form->field($model, 'cd') ?>

    <?php // echo $form->field($model, 'floppy') ?>

    <?php // echo $form->field($model, 'stilaz') ?>

    <?php // echo $form->field($model, 'polka') ?>

    <?php // echo $form->field($model, 'is_block') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('book', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('book', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
