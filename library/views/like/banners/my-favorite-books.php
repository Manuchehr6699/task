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
        <h2><?= Yii::t('univer', 'My Favorite Books') ?></h2>
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>
