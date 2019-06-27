<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\library\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'flagIzmen')->dropDownList([ 'y' => 'Y', 'n' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'flagIzYak')->dropDownList([ 'y' => 'Y', 'n' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'flagIzAgro')->dropDownList([ 'y' => 'Y', 'n' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'doc_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_num')->textInput() ?>

    <?= $form->field($model, 'doc_year')->textInput() ?>

    <?= $form->field($model, 'book_id_start')->textInput() ?>

    <?= $form->field($model, 'book_naimen_id')->textInput() ?>

    <?= $form->field($model, 'lot_id')->textInput() ?>

    <?= $form->field($model, 'book_count')->textInput() ?>

    <?= $form->field($model, 'naimen')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'book_author')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'izdan')->textInput() ?>

    <?= $form->field($model, 'soli_nashr')->textInput() ?>

    <?= $form->field($model, 'nashriyot_id')->textInput() ?>

    <?= $form->field($model, 'joi_nashr_id')->textInput() ?>

    <?= $form->field($model, 'count_page')->textInput() ?>

    <?= $form->field($model, 'book_language_id')->textInput() ?>

    <?= $form->field($model, 'format')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISBN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BBK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UDK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_now')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cover_id')->textInput() ?>

    <?= $form->field($model, 'cat_id')->textInput() ?>

    <?= $form->field($model, 'seriya_id')->textInput() ?>

    <?= $form->field($model, 'describe')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cd')->dropDownList([ 'y' => 'Y', 'n' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'floppy')->dropDownList([ 'y' => 'Y', 'n' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'stilaz')->textInput() ?>

    <?= $form->field($model, 'polka')->textInput() ?>

    <?= $form->field($model, 'is_block')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('book', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
