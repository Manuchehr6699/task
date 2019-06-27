<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 03.01.2019
 * Time: 20:40
 */

$this->title = Yii::t('univer', 'Book Details of') .' '.$data['naimen'];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= $this->render('/book/banners/list-books-sidebar', [
        'data' => $data['naimen']
]); ?>

<div class="kode-content padding-tb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar">
                <!--SEARCH WIDGET START-->
                <div class="widget widget-new-arrival">
                    <h2><?= Yii::t('app', 'New Books') ?></h2>
                    <ul>
                        <?= \app\components\SideNewBooksWidget::widget(['tpl' => 'new-book']) ?>
                    </ul>
                </div>
                <!--NEW ARRIVAL WIDGET END-->
                <!--CATEGORY WIDGET START-->
                <div class="widget widget-categories">
                    <h2><?= Yii::t('app', 'Categories') ?></h2>
                    <ul>
                    <?= \app\components\MenuWidget::widget(['tpl' => 'menu']) ?>
                    </ul>
                </div>
                <!--CATEGORY WIDGET END-->
                <!--NEW ARRIVAL WIDGET START-->
                <div class="widget widget-new-arrival">
                    <h2><?= Yii::t('book', 'Best Books (TOP-10)') ?></h2>
                    <ul class="bxslider">
                        <?= \app\components\SideNewBooksWidget::widget(['tpl' => 'new-book', 'widget_type' => 'best']) ?>
                    </ul>
                </div>
                <!--NEW ARRIVAL WIDGET END-->
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php if (!empty($data)): ?>
                        <!--BOOK DETAIL START-->
                        <div class="lib-book-detail" style="margin: 15px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="kode-thumb">
                                        <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/library/book_img/1/'.$data['book_naimen_id'].'.jpg')): ?>
                                        <img src="<?='/uploads/library/book_img/1/'.$data['book_naimen_id'].'.jpg' ?>" alt="">
                                        <?php else: ?>
                                            <img src="/images/no_photo.png" alt="">
                                        <?php endif; ?>
                                        <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/library/book_img/1/'.$data['book_naimen_id'].'.jpg')): ?>
                                            <img src="<?='/uploads/library/book_img/2/'.$data['book_naimen_id'].'.jpg' ?>" alt="">
                                        <?php else: ?>
                                            <img src="/images/no_photo.png" alt="">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="kode-text">
                                        <h2><?= $data['naimen'] ?></h2>
                                        <div class="product-price">
                                            <h4><?= Yii::t('app', 'Quantity:').' '. $data['book_count'] ?></h4>
                                            <p><?= Yii::t('book', 'Author:').' ' ?><span class="color"><?= $data['book_author'] ?></span></p>
                                        </div>

                                        <div class="book-text">
                                            <p><?= Yii::t('book', 'Category'). ': '. $data['category'] ?><?php if(empty($data['category'])) echo '---'; ?></p>
                                            <p><?= Yii::t('book', 'Series'). ': '. $data['seriya'] ?><?php if(empty($data['seriya'])) echo '---'; ?></p>
                                            <p><?= Yii::t('book', 'Publisher'). ': '. $data['nashriyot'] ?><?php if(empty($data['nashriyot'])) echo '---'; ?></p>
                                            <p><?= Yii::t('book', 'Publish Year'). ': '. $data['soli_nashr'] ?><?php if(empty($data['soli_nashr'])) echo '---'; ?></p>
                                            <p><?= Yii::t('book', 'Publish Place'). ': '. $data['joi_nashr'] ?><?php if(empty($data['joi_nashr'])) echo '---'; ?></p>

                                            <p><?= Yii::t('book', 'Language'). ': '. $data['language'] ?><?php if(empty($data['language'])) echo '---'; ?></p>
                                            <p><?= Yii::t('book', 'Page Count'). ': '. $data['count_page'] ?><?php if(empty($data['count_page'])) echo '---'; ?></p>
                                            <p>
                                                <?php echo Yii::t('book', 'CD') . ': ';
                                                if($data['cd'] == 'n') echo '<i class="fa fa-times text-danger"></i>';
                                                else echo '<i class="fa fa-check text-success"></i>';
                                                ?>
                                            </p>
                                            <p>
                                                <?php echo Yii::t('book', 'Floppy') . ': ';
                                                if($data['floppy'] == 'n') echo '<i class="fa fa-times text-danger"></i>';
                                                else echo '<i class="fa fa-check text-success"></i>';
                                                ?>
                                            </p>
                                            <p><?= Yii::t('book', 'Library'). ': '. Yii::$app->getbookinfo->getLibs($data['book_naimen_id'])?></p>
                                            <b><?= Yii::t('book', 'Book ID'). ': <b>'. $data['book_naimen_id'] ?></b></p>
                                        </div>
                                        <div class="book-text">
                                            <p><?php if(empty($data['describe'])) echo '---'; else echo $data['describe']; ?></p>
                                        </div>
                                        <?php if (!Yii::$app->user->isGuest): ?>
                                            <div class="book-text">
                                                <br>
                                                <div class="rating">
                                                    <?php
                                                    $l = \app\modules\library\models\LikeBook::find()
                                                        ->where(['user_id' => Yii::$app->getuserinfo->getId()])
                                                        ->andWhere(['book_naimen_id' => $data['book_naimen_id']])
                                                        ->andWhere(['book_type' => 'O'])->asArray()->one();
                                                    if (!empty($l)):
                                                        ?>
                                                        <span class="add-to-like like" data-id="<?= $data['book_naimen_id'] ?>"><i
                                                                    class="fa fa-heart"></i></span>
                                                    <?php else: ?>
                                                        <span class="add-to-like" data-id="<?= $data['book_naimen_id'] ?>"><i
                                                                    class="fa fa-heart"></i></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div id="likecount<?= $data['book_naimen_id'] ?>"
                                                     style="color: blue; font-weight: bold;"></div><br>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!Yii::$app->user->isGuest && $data['book_count'] > 1): ?>
                                            <a href="<?= \yii\helpers\Url::to(['/library/order/add', 'id' => $data['book_naimen_id']]) ?>"
                                               class="add-to-cart"  data-id="<?= $data['book_naimen_id'] ?>"><i
                                                        class="fa fa-book"></i>
                                                <?= Yii::t('book', 'Add To Order') ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BOOK DETAIL END-->


                    <?php else: ?>
                        <h2><?= Yii::t('app', 'Here books not found...') ?></h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
