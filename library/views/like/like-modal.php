<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 01.01.2019
 * Time: 23:22
 */
if (!empty($user_likes) || !empty($us_eb_like)):
    ?>
    <div class="table-resposive">
        <table class="table table-hover" style="margin-bottom: 60px" id="tbl_orders"
               data-text="<?= Yii::$app->getuserinfo->getId() ?>">
            <thead>
            <th>№</th>
            <th></th>
            <th><?= Yii::t('book', 'Photo') ?></th>
            <th><?= Yii::t('book', 'Title') ?></th>
            <th><?= Yii::t('book', 'Author') ?></th>
            <th><span class="fa fa-heart" aria-hidden="true"></span></th>
            </thead>
            <tbody>

            <?php $i = 0;
            if (!empty($user_likes)) {
                foreach ($user_likes as $like): $i++; ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <?php if ($like['book_type'] == 'O'): ?>
                                <span class="fa fa-book text-blue"></span>
                            <?php else: ?>
                                <span class="fa fa-desktop text-blue"></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/library/book_img/1/' . $like['book_naimen_id'] . '.jpg')): ?>
                                <img src="<?= '/uploads/library/book_img/1/' . $like['book_naimen_id'] . '.jpg' ?>"
                                     alt="" width="70px">
                            <?php else: ?>
                                <img src="/images/no_photo.png" alt="" width="70px">
                            <?php endif; ?>
                        </td>
                        <td><?= $like['naimen']; ?></td>
                        <td><?= $like['book_author'] ?></td>
                        <td>
                                <span class="fa fa-heart del-item" aria-hidden="true"
                                      data-id="<?= $like['book_naimen_id'] ?>"
                                      style="color: red;"></span>
                        </td>
                        <?php $sum += 1; ?>
                    </tr>
                <?php endforeach;
            } ?>

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
                        <span class="fa fa-heart del-item-ebook-like" aria-hidden="true"
                              data-id="<?= $like2['ebook_id'] ?>" style="color: red;"></span>
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
<?php else: ?>
    <h3><?= Yii::t('app', 'You Favorite Books is empty') ?></h3>
<?php endif; ?>
