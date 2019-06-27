<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 01.01.2019
 * Time: 23:22
 */
if (!empty($user_orders)):
    ?>
    <div class="table-resposive">
        <table class="table table-hover" id="tbl_orders" data-text="<?= Yii::$app->getuserinfo->getId() ?>">
            <thead>
            <th>№</th>
            <th><?= Yii::t('book', 'Photo') ?></th>
            <th><?= Yii::t('book', 'Title') ?></th>
            <th><?= Yii::t('book', 'Author') ?></th>
            <th><?= Yii::t('book', 'Order Date') ?></th>
            <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </thead>
            <tbody>
            <?php $i = 0; foreach ($user_orders as $order): $i++; ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= '<img src="/images/no_photo.png" width="60px">'; ?></td>
                    <td><?= $order['naimen']; ?></td>
                    <td><?= $order['book_author'] ?></td>
                    <td><?= $order['order_date'] ?></td>
                    <td><a href="/library/book/del-order-item?id="<?= $order['book_naimen_id']?>><span class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true" data-id="<?= $order['book_naimen_id'] ?>"></span></a></td>
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
    <h3><?= Yii::t('app', 'You orders is empty') ?></h3>
<?php endif; ?>
