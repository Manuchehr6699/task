<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskSentence */

$this->title = 'Изменить задание: ' . $model->sentence_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Sentences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sentence_id, 'url' => ['view', 'id' => $model->sentence_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-sentence-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
