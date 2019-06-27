<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 01.01.2019
 * Time: 9:35
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;

?>
<!--BANNER START-->
<div class="kode-inner-banner">
    <div class="kode-page-heading">
        <h2><?= Yii::t('univer', 'System Search Books') ?></h2>
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>
<div class="search-section" style="background-color: grey">
    <div class="container">
        <div class="form-container">
            <div class="row">
                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'enableClientValidation'=> false,
                    'method' => 'get',
                    'options' => [
                        'class' => 'system-book-search'
                    ],
                ]); ?>
                <div class="col-md-4 col-xs-12">
                    <?= $form->field($model, 'cat_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\app\modules\library\models\Category::find()->where(['is_block' => 0])->orderBy('category')->all(),'category_id','category'),
                        'options' => ['placeholder' => Yii::t('app', '---  Select Category ---')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
                <div class="col-md-4 col-xs-12">
                    <?= $form->field($model, 'seriya_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\app\modules\admin\modules\bookdetail\models\BookSeriya::find()->where(['is_block' => 0])->orderBy('seriya_name')->all(),'seriya_id','seriya_name'),
                        'options' => ['placeholder' => Yii::t('app', '---  Select Seriya ---')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
                <div class="col-md-4 col-xs-12">
                    <?= $form->field($model, 'cover_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\app\modules\admin\modules\bookdetail\models\BookCoverType::find()->where(['is_block' => 0])->orderBy('cover_type')->all(),'cover_id','cover_type'),
                        'options' => ['placeholder' => Yii::t('app', '---  Select Seriya ---')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
<!--                <div class="col-md-4 col-xs-12">-->
<!--                    --><?//= $form->field($model, 'discipline_id')->widget(Select2::classname(), [
//                        'data' => ArrayHelper::map(\app\modules\library\models\Discipline::find()->where(['is_block' => 0])->orderBy('discipline_name')->all(),'discipline_id','discipline_name'),
//                        'options' => ['placeholder' => Yii::t('app', '---  Select Discipline ---')],
//                        'pluginOptions' => [
//                            'allowClear' => true
//                        ],
//                    ]); ?>
<!--                </div>-->
<!--                <div class="col-md-4 col-xs-12">-->
<!--                    --><?//= $form->field($model, 'spec_code')->widget(Select2::classname(), [
//                        'data' => ArrayHelper::map(\app\modules\library\models\Specialnost::find()->where(['is_block' => 0])->orderBy('spec_code')->all(),'spec_code','spec_tj'),
//                        'options' => ['placeholder' => Yii::t('app', '---  Select Specialty ---')],
//                        'pluginOptions' => [
//                            'allowClear' => true
//                        ],
//                    ]); ?>
<!--                </div>-->
            </div>
            <div class="row">
                <div class="col-md-2 col-xs-12" style="margin-top: 15px">
                    <?= Html::submitButton(Yii::t('book', 'Search'), ['class' => 'btn btn-primary']) ?>
                </div>
                <div class="col-md-2 col-xs-12" style="margin-top: 15px">
                    <?= Html::resetButton(Yii::t('book', 'Clear'), ['class' => 'btn btn-default']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
