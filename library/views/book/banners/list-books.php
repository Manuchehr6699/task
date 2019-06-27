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
        <h2><?= Yii::t('univer', 'Books For Order') ?></h2>
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>
<!--BANNER END-->
<div class="search-section" style="background-color: grey">
    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><a href="#Author" aria-controls="Author" role="tab" data-toggle="tab"><?= Yii::t('book', 'Book Author') ?></a></li>
            <li role="presentation" class="active"><a href="#Basic" aria-controls="Basic" role="tab" data-toggle="tab"><?= Yii::t('book', 'Books') ?></a></li>
            <li role="presentation"><a href="#Publications" aria-controls="Publications" role="tab" data-toggle="tab"><?= Yii::t('book', 'Publisher') ?></a>
            <li role="presentation"><a href="#Specialty" aria-controls="Specialty" role="tab" data-toggle="tab"><?= Yii::t('book', 'Specialty') ?></a>
            <li role="presentation"><a href="#Discipline" aria-controls="Discipline" role="tab" data-toggle="tab"><?= Yii::t('book', 'Discipline') ?></a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="Author">
                <div class="form-container">
                    <div class="row">
                        <form action="/library/book/list-books">
                        <div class="col-md-8 col-sm-12">
                            <input type="text" name="author" placeholder="<?= Yii::t('app', 'Enter author name...') ?>">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <button><?= Yii::t('app', 'Search Author') ?></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active" id="Basic">
                <div class="form-container">
                    <div class="row">
                        <form action="/library/book/list-books">
                            <div class="col-md-8 col-sm-12">
                                <input type="text" name="book_title" placeholder="<?= Yii::t('app', 'Enter book title...') ?>">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <button type="submit"><?= Yii::t('app', 'Search Book') ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="Publications">
                <div class="form-container">
                    <form action="/library/book/list-books">
                        <div class="col-md-8 col-sm-12">
                            <input type="text" name="publisher" placeholder="<?= Yii::t('app', 'Enter publisher...') ?>">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <button type="submit"><?= Yii::t('app', 'Search Publisher') ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="Specialty">
                <div class="form-container">
                    <?php $form = ActiveForm::begin([
                        'id' => 'specialty-search',
                        'action' => '/library/book/list-books',
                        'method' => 'get',
                        'fieldConfig' => [
                            'template' => "{input}{error}",
                        ],
                    ]); ?>
                    <div class="col-md-5 col-sm-12">
                    <?= $form->field($kafedra, 'kafedra_id')->dropDownList(ArrayHelper::map(\app\modules\library\models\Kafedra::find()->select('kafedra_id, kafedra_taj')->where(['status_of_kaf' => 'on'])->asArray()->all(),'kafedra_id','kafedra_taj'),
                        [
                            'prompt'=>Yii::t('app', '--- Select Kafedra ---'),
                            'onchange'=>'
                        $.get( "'.Url::toRoute('/library/dependent/kafspec').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($spec, 'spec_code').'" ).html( data );
                            }
                        );'
                        ]); ?>
                    </div>
                    <div class="col-md-5 col-sm-12">
<!--                    --><?//= $form->field($spec, 'spec_code')->dropDownList(
//                        ArrayHelper::map(\app\modules\library\models\Specialnost::find()->select('spec_code, spec_tj')->where(['is_block' => 0])->asArray()->all(),'spec_code','spec_tj'),
//                            ['prompt'=>Yii::t('app', '--- Select Specialty ---')]); ?>
                        <?= $form->field($spec, 'spec_code')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(\app\modules\library\models\Specialnost::find()->select('spec_code, spec_tj')->where(['is_block' => 0])->asArray()->all(),'spec_code','spec_tj'),
                            'options' => ['placeholder' => Yii::t('app', '---  Select Specialty ---')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <button type="submit" style="height: 40px;"><?= Yii::t('app', 'Search') ?></button>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="Discipline">
                <div class="form-container">
                    <?php $form = ActiveForm::begin([
                        'id' => 'discipline-search',
                        'action' => '/library/book/list-books',
                        'method' => 'get',
                        'fieldConfig' => [
                            'template' => "{input}{error}",
                        ],
                    ]); ?>
                    <div class="col-md-5 col-sm-12">
                        <?= $form->field($dis_cat, 'dis_cat_id')->dropDownList(ArrayHelper::map(\app\modules\library\models\DisciplineCategory::find()->where(['is_block' => '0'])->orderBy('dis_cat_name')->asArray()->all(),'dis_cat_id','dis_cat_name'),
                            [
                                'prompt'=>Yii::t('app', '--- Select Discipline Category ---'),
                                'onchange'=>'
                        $.get( "'.Url::toRoute('/library/dependent/discat').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($dis, 'discipline_id').'" ).html( data );
                            }
                        );'
                            ]); ?>
                    </div>
                    <div class="col-md-5 col-sm-12">
<!--                        --><?//= $form->field($dis, 'discipline_id')->dropDownList(
//                            //ArrayHelper::map(\app\modules\library\models\Discipline::find()->where(['is_block' => '0'])->orderBy('discipline_name')->asArray()->all(),'discipline_id','discipline_name'),
//                                ['prompt'=>Yii::t('app', '--- Select Discipline ---')]);
//                                ?>
                            <?= $form->field($dis, 'discipline_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\app\modules\library\models\Discipline::find()->where(['is_block' => '0'])->asArray()->all(),'discipline_id','discipline_name'),
                                'options' => ['placeholder' => Yii::t('app', '---  Select Discipline ---')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>

                    </div>
                    <div class="col-md-2 col-sm-12">
                        <button type="submit" style="height: 40px;"><?= Yii::t('app', 'Search') ?></button>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
