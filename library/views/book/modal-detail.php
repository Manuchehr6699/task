<!--BOOK DETAIL START-->
<div class="lib-book-detail" style="margin: 15px;">
    <div class="row">
        <div class="col-md-3">
            <div class="kode-thumb">
                <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/library/book_img/1/'.$book['book_naimen_id'].'.jpg')): ?>
                    <img src="<?='/uploads/library/book_img/1/'.$book['book_naimen_id'].'.jpg' ?>" alt="">
                <?php else: ?>
                    <img src="/images/no_photo.png" alt="">
                <?php endif; ?>
                <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/library/book_img/1/'.$book['book_naimen_id'].'.jpg')): ?>
                    <img src="<?='/uploads/library/book_img/2/'.$book['book_naimen_id'].'.jpg' ?>" alt="">
                <?php else: ?>
                    <img src="/images/no_photo.png" alt="">
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="kode-text">
                <h2><?= $book['naimen'] ?></h2>
                <div class="product-price">
                    <h4><?= Yii::t('app', 'Quantity:').' '. $book['book_count'] ?></h4>
                    <p><?= Yii::t('book', 'Author:').' ' ?><span class="color"><?= $book['book_author'] ?></span></p>
                </div>

                <div class="book-text">
                    <p><?= Yii::t('book', 'Category'). ': '. $book['category'] ?><?php if(empty($book['category'])) echo '---'; ?></p>
                    <p><?= Yii::t('book', 'Series'). ': '. $book['seriya'] ?><?php if(empty($book['seriya'])) echo '---'; ?></p>
                    <p><?= Yii::t('book', 'Publisher'). ': '. $book['nashriyot'] ?><?php if(empty($book['nashriyot'])) echo '---'; ?></p>
                    <p><?= Yii::t('book', 'Publish Year'). ': '. $book['soli_nashr'] ?><?php if(empty($book['soli_nashr'])) echo '---'; ?></p>
                    <p><?= Yii::t('book', 'Publish Place'). ': '. $book['joi_nashr'] ?><?php if(empty($book['joi_nashr'])) echo '---'; ?></p>
                    <p><?= Yii::t('book', 'Language'). ': '. $book['language'] ?><?php if(empty($book['language'])) echo '---'; ?></p>
                    <p><?= Yii::t('book', 'Page Count'). ': '. $book['count_page'] ?><?php if(empty($book['count_page'])) echo '---'; ?></p>
                    <p>
                        <?php echo Yii::t('book', 'CD') . ': ';
                        if($book['cd'] == 'n') echo '<i class="fa fa-times text-danger"></i>';
                        else echo '<i class="fa fa-check text-success"></i>';
                        ?>
                    </p>
                    <p>
                        <?php echo Yii::t('book', 'Floppy') . ': ';
                        if($book['floppy'] == 'n') echo '<i class="fa fa-times text-danger"></i>';
                        else echo '<i class="fa fa-check text-success"></i>';
                        ?>
                    </p>
                    <p><?= Yii::t('book', 'Library'). ': '. Yii::$app->getbookinfo->getLibs($book['book_naimen_id']) ?></p>
                    <p><?= Yii::t('book', 'Book ID'). ': '. $book['book_naimen_id'] ?></p>

                </div>
                <div class="book-text">
                    <p><?php if(empty($book['describe'])) echo '---'; else echo $book['describe']; ?></p>
                </div>
                <?php if (!Yii::$app->user->isGuest && $book['book_count'] > 1): ?>
                    <a href="<?= \yii\helpers\Url::to(['/library/order/add-from-modal', 'id' => $book['book_naimen_id']]) ?>"
                       class="add-to-cart"  data-id="<?= $book['book_naimen_id'] ?>"><i
                                class="fa fa-book"></i>
                        <?= Yii::t('book', 'Add To Order') ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!--BOOK DETAIL END-->
