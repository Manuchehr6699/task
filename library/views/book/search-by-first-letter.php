<?php

$this->title = Yii::t('univer', 'Search By First Letter');
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/book/banners/search-by-first-letter',
    ['engLet' => $engLet, 'rusLet' => $rusLet]);
?>

<!--CONTENT START-->
<div class="kode-content padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php if (!empty($books)): ?>
                        <?php if ($is_search == 1): ?>
                            <h3>
                                <?= Yii::t('app', 'Results found In Letter'). ' '. $let . ' - ' . $result_count . '.' ?>
                                <?php if (!empty($is_cat)): ?>
                                    <?= Yii::t('app', 'Category') . ': ' . $is_cat ?>
                                <?php endif; ?>
                            </h3>
                        <?php endif; ?>
                        <?php foreach ($books as $book): ?>
                            <!--BOOK LISTING START-->
                            <div class="col-md-3 col-sm-6">
                                <div class="books-listing-4">
                                    <div class="kode-thumb">
                                        <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/library/book_img/1/'.$book->book_naimen_id.'.jpg')): ?>
                                            <img src="<?='/uploads/library/book_img/1/'.$book->book_naimen_id.'.jpg' ?>" alt="">
                                        <?php else: ?>
                                            <img src="/images/no_photo.png" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="kode-text">
                                        <h3><a href="#" class="title_book"  data-id="<?= $book->book_naimen_id ?>" title="<?= Yii::t('univer', 'Read More') ?>"><?= mb_substr($book->naimen, 0, 15).'...' ?></a></h3>
                                        <p><?= mb_substr($book->book_author, 0, 15). '...' ?></p>
                                    </div>
                                    <div class="book-price">
                                        <p><?= Yii::t('app', 'Quantity:').' '. $book->book_count ?></p>
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
                                                 style="color: black;"></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!Yii::$app->user->isGuest && $book->book_count > 1): ?>
                                        <a href="<?= \yii\helpers\Url::to(['/library/order/add', 'id' => $book->book_naimen_id]) ?>"
                                           class="add-to-cart" style="width: 50%" data-id="<?= $book->book_naimen_id ?>"><i
                                                class="fa fa-book"></i>
                                            <?= Yii::t('book', 'Add To Order') ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!--BOOK LISTING END-->
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
    </div>
</div>
<!--CONTENT END-->
<?php \yii\bootstrap\Modal::begin([
    'header' => '<h3 style="color: white">'.Yii::t('book', 'Book Details').'<h3>',
    'id' => 'details',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">'.Yii::t('app', 'Close').'</button>'
]);
\yii\bootstrap\Modal::end();
?>
