<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TaskSentenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список заданий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-sentence-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sentence_id',
            'text_id',
            'senctence',
            'is_block',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
