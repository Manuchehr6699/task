<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 23.03.2019
 * Time: 0:08
 */
use yii\helpers\Html;
$this->title = 'Выбор заданий';
?>

<div class="play">
    <h2>Выбор заданий</h2>
    <?php if (empty($tasks)): ?>
        <div class="jumbotron">
            <h2>Задание не существует!</h2>
        </div>

    <?php else: ?>
        <table class="table table-responsive table-bordered task-list">
            <tr>
            <?php $i=0; foreach ($tasks as $task): $i++;
                $cc = \backend\models\Result::find()->where(['user_id' => Yii::$app->user->getId(),
                    'sentence_id' => $task['sentence_id']])->one();
                ?>
                <?php if($cc['type'] == 'win'): ?>
                <th style="background-color: greenyellow">
                    <?= Html::a("Задание № ". $task['sentence_id'], "/play/decision?task=".$task['sentence_id']) ?>
                </th>
                <?php elseif($cc['type'] == 'lose'): ?>
                <th style="background-color: lightgray">
                    <?= Html::a("Задание № ". $task['sentence_id'], "/play/decision?task=".$task['sentence_id']) ?>
                </th>
                <?php else: ?>
                    <th>
                        <?= Html::a("Задание № ". $task['sentence_id'], "/play/decision?task=".$task['sentence_id']) ?>
                    </th>
                <?php endif; ?>

            <?php if ($i == 3) { echo '</tr>'; $i=0; } endforeach; ?>
            </tr>
        </table>
    <?php endif; ?>
</div>