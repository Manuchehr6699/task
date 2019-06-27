<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 01.01.2019
 * Time: 23:22
 */
use yii\helpers\Html;

$this->title = Yii::t('univer', 'My Favorite Books');
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/like/banners/my-favorite-books');
if (!empty($user_likes) || !empty($us_eb_like)): ?>
<div class="col-md-12">
    <div class="table-resposive">
        <table class="table table-hover" id="tbl_orders" style="margin-top: 40px; margin-bottom: 60px" data-text="<?= Yii::$app->getuserinfo->getId() ?>">
            <thead>
            <tr><th colspan="6" style="text-align: center"><h5><?= Yii::t('univer', 'List of checked books') ?></h5></th></tr>
            <th>№</th>
            <th></th>
            <th><?= Yii::t('book', 'Photo') ?></th>
            <th><?= Yii::t('book', 'Title') ?></th>
            <th><?= Yii::t('book', 'Author') ?></th>
            <th><span class="fa fa-heart" aria-hidden="true"></span></th>
            </thead>
            <tbody>
            <?php $i = 0; if(!empty($user_likes)) { foreach ($user_likes as $like): $i++; ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <?php if($like['book_type'] == 'O'): ?>
                            <span class="fa fa-book text-blue"></span>
                        <?php else: ?>
                            <span class="fa fa-desktop text-blue"></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/library/book_img/1/'.$like['book_naimen_id'].'.jpg')): ?>
                            <img src="<?='/uploads/library/book_img/1/'.$like['book_naimen_id'].'.jpg' ?>" alt="" width="70px">
                        <?php else: ?>
                            <img src="/images/no_photo.png" alt="" width="70px">
                        <?php endif; ?>
                    </td>
                    <td><?= $like['naimen']; ?></td>
                    <td><?= $like['book_author'] ?></td>
                    <td><?= Html::a('<i class="ace-icon fa fa-trash-o bigger-120"></i>', '/library/like/delete?id='.$like['book_naimen_id'].'&type='.$like['book_type'], ['title' => Yii::t('app', 'Delete'), 'aria-label' => Yii::t('app', 'Delete'), 'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method' => 'post', 'class'=>'btn btn-xs btn-danger']); ?></td>
                    <?php $sum += 1; ?>
                </tr>
            <?php endforeach; } ?>
            <?php foreach ($us_eb_like as $like2): $i++; ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <?php if ($like2['book_type'] == 'O'): ?>
                            <span class="fa fa-book text-blue"></span>
                        <?php else: ?>
                            <span class="fa fa-desktop text-blue"></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/elibrary/ebooks_images/' . $like2['ebk_img'])): ?>
                            <img src="<?= '/uploads/elibrary/ebooks_images/' . $like2['ebk_img'] ?>"
                                 alt="" width="70px">
                        <?php else: ?>
                            <img src="/images/no_photo.png" alt="" width="70px">
                        <?php endif; ?>
                    </td>
                    <td><?= $like2['title']; ?></td>
                    <td><?= $like2['author'] ?></td>
                    <td>
                        <?= Html::a('<i class="ace-icon fa fa-trash-o bigger-120"></i>', '/library/like/delete?id='.$like2['ebook_id'].'&type='.$like2['book_type'], ['title' => Yii::t('app', 'Delete'), 'aria-label' => Yii::t('app', 'Delete'), 'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method' => 'post', 'class'=>'btn btn-xs btn-danger']); ?>
                    </td>
                    <?php $sum += 1; ?>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="5"><b><?= Yii::t('doc', 'Total') ?></b></td>
                <td><b><?= $sum ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
    <h3 style="margin: 40px"><?= Yii::t('app', 'You Favorite Books is empty') ?></h3>
<?php endif; ?>
