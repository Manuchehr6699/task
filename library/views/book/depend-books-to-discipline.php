<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 18.03.2019
 * Time: 13:51
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use softark\duallistbox\DualListbox;
$this->title = Yii::t('book', 'Dependent Books To Discipline');
?>

<div class="kode-content">
    <section>
        <div class="container">
            <div class="section-heading-1">
                <h3><?= Yii::t('book', 'Dependent Books To Discipline') ?></h3>
                <p><?= $book_naimen['naimen'] ?></p>
                <div class="kode-icon"><i class="fa fa-book"></i></div>
            </div>
            <div class="row">
                <?php $form = ActiveForm::begin([
                    'id' => 'favorite-form',
                    'enableAjaxValidation' => false,
                ]); ?>
                <?= $form->field($model, 'naimen_id')->hiddenInput(['value' => $book_naimen_id])->label(false) ?>
                <?php echo $form->field($model, 'discipline_id')->widget(DualListbox::className(), [
                    'items' => $items,
                        'options' => [
                        'multiple' => true,
                        'size' => 10,
                        ],
                    'clientOptions' => [
                        'nonSelectedListLabel' => Yii::t('book', 'Available Disciplines'),
                        'selectedListLabel' => Yii::t('book', 'Dependent Disciplines'),
                        'moveOnSelect' => false,
                    ],
                ])->label(false)->hint(Yii::t('app', 'For Depending Move Disciplines To Right Side'));
                ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('book', 'Confirm'), ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
</div>