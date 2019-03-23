<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskSentence */

$this->title = 'Создать задание';
$this->params['breadcrumbs'][] = ['label' => 'Task Sentences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-sentence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
