<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskText */

$this->title = 'Create Task Text';
$this->params['breadcrumbs'][] = ['label' => 'Task Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-text-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
