<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 18.03.2019
 * Time: 16:13
 */
use yii\helpers\Html;
$this->title = Yii::t('book', 'List Books For Depend To Disciplines');
?>

<div class="kode-content">
    <section>
        <div class="container">
            <div class="row">
                <h2 style="text-align: center"><?= Yii::t('book', 'List Books For Depend To Disciplines') ?></h2>

                <?php if (Yii::$app->session->hasFlash('depend_error')): ?>
                    <div class="alert alert-warning" role="alert">
                        <?= '<i class="glyphicon glyphicon-warning-sign"></i>' .' '. Yii::$app->session->getFlash('depend_error') ?>
                    </div>
                <?php elseif (Yii::$app->session->hasFlash('depend_success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= '<i class="glyphicon glyphicon-ok-sign"></i>' .' '. Yii::$app->session->getFlash('depend_success') ?>
                    </div>
                <?php endif; ?>
                <?= Yii::t('doc', 'Amount All Naimen').' - '. $count ?>
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col"><?= Yii::t('book', 'Naimen') ?></th>
                        <th scope="col"><?= Yii::t('book', 'Book Author') ?></th>
                        <th scope="col"><?= Yii::t('book', 'Publish Year') ?></th>
                        <th scope="col"><?= Yii::t('book', 'Publisher Location') ?></th>
                        <th scope="col"><?= Yii::t('book', 'Language') ?></th>
                        <th scope="col"><?= Yii::t('book', 'Category') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $raw): ?>
                        <tr>
                            <th><?= ++$i ?></th>
                            <td><?= Html::a($raw['naimen'], '/library/book/depend-books-to-disciplines?id='.$raw['book_naimen_id']) ?></td>
                            <td><?= $raw['book_author'] ?></td>
                            <td><?= $raw['soli_nashr'] ?></td>
                            <td><?= $raw['joi_nashr'] ?></td>
                            <td><?= $raw['language'] ?></td>
                            <td><?= $raw['category'] ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <?php echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ])
                ?>
            </div>
        </div>
    </section>
</div>

