<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 01.01.2019
 * Time: 8:55
 */
$this->title = Yii::t('univer', 'Books For Order');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('/book/banners/list-books', [
        'kafedra' => $kafedra,
        'dis_cat' => $dis_cat,
        'spec' => $spec,
        'dis' => $dis,
]); ?>
<!--CONTENT START-->
<div class="kode-content padding-tb-50">
    <!--TOP AUTHERS START-->
    <div class="container">
        <div class="kode-product-filter">
        </div>
        <div class="row">
            <!--PRODUCT GRID START-->
            <?php if (!empty($books)): ?>
                <?php if ($is_search == 1 && empty($is_spec)): ?>
                    <h3><?= Yii::t('app', 'Results found') . ' - ' . $result_count ?></h3>
                <?php elseif(!empty($is_spec)): ?>
                    <h3><?= Yii::t('app', 'Results found') . ' - ' . $result_count.' '.Yii::t('book', 'Specialty').' '.$is_spec ?></h3>
                <?php endif; ?>
                <?php foreach ($books as $book): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="best-seller-pro">
                            <figure>
                                <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/library/book_img/1/'.$book->book_naimen_id.'.jpg')): ?>
                                    <img src="<?='/uploads/library/book_img/1/'.$book->book_naimen_id.'.jpg' ?>" alt="">
                                <?php else: ?>
                                    <img src="/images/no_photo.png" alt="">
                                <?php endif; ?>
                            </figure>
                            <div class="kode-text">
                                <h3>
                                    <?php
                                    echo mb_substr($book->naimen, 0, 16) . '...'
                                    ?>
                                </h3>
                            </div>
                            <div class="kode-caption">
                                <h3><?= mb_substr($book->naimen, 0, 70) ?></h3>
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <div class="rating">
                                        <?php
                                        $l = \app\modules\library\models\LikeBook::find()
                                            ->where(['user_id' => Yii::$app->getuserinfo->getId()])
                                            ->andWhere(['book_naimen_id' => $book->book_naimen_id])
                                            ->andWhere(['book_type' => 'O'])->asArray()->one();
                                        if (!empty($l)):
                                            ?>
                                            <span class="add-to-like like" data-id="<?= $book->book_naimen_id ?>"><i
                                                        class="fa fa-heart"></i></span>
                                        <?php else: ?>
                                            <span class="add-to-like" data-id="<?= $book->book_naimen_id ?>"><i
                                                        class="fa fa-heart"></i></span>
                                        <?php endif; ?>
                                    </div>
                                    <div id="likecount<?= $book->book_naimen_id ?>"
                                         style="color: white; font-weight: bold;"></div>
                                <?php endif; ?>
                                <p><?= $book->book_author ?></p>
                                <p class="price"><?= Yii::t('app', 'Quantity:') . ' ' . $book->book_count ?></p>
                                <?php if (!Yii::$app->user->isGuest && $book->book_count > 1): ?>
                                    <a href="<?= \yii\helpers\Url::to(['/library/order/add', 'id' => $book->book_naimen_id]) ?>"
                                       class="add-to-cart" data-id="<?= $book->book_naimen_id ?>"><i
                                                class="fa fa-book"></i>
                                        <?= Yii::t('book', 'Add To Order') ?></a>
                                <?php endif; ?>
                                <a href="<?= \yii\helpers\Url::to(['/library/book/view-book-details', 'id' => $book->book_naimen_id]) ?>" target="_blank" style="margin-top: 5px"><p><?= Yii::t('univer', 'Read More') ?></p></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
                <?php echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ])
                ?>
            <?php else: ?>
                <h2><?= Yii::t('app', 'Here books not found...') ?></h2>
            <?php endif; ?>
        </div>
    </div>
</div>