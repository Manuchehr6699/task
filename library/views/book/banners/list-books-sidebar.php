<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 01.01.2019
 * Time: 9:35
 */
?>
<!--BANNER START-->
<div class="kode-inner-banner">
    <div class="kode-page-heading">
        <h2><?= Yii::t('univer', 'Search by category')?></h2>
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>
<!--BANNER END-->
<div class="search-section" style="background-color: grey">
    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><a href="#Author" aria-controls="Author" role="tab" data-toggle="tab"><?= Yii::t('book', 'Book Author') ?></a></li>
            <li role="presentation" class="active"><a href="#Basic" aria-controls="Basic" role="tab" data-toggle="tab"><?= Yii::t('book', 'Books') ?></a></li>
            <li role="presentation"><a href="#Publications" aria-controls="Publications" role="tab" data-toggle="tab"><?= Yii::t('book', 'Publisher') ?></a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="Author">
                <div class="form-container">
                    <div class="row">
                        <form action="/library/book/list-books-sidebar">
                        <div class="col-md-8 col-sm-12">
                            <input type="text" name="author" placeholder="<?= Yii::t('app', 'Enter author name...') ?>">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <button><?= Yii::t('app', 'Search Author') ?></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active" id="Basic">
                <div class="form-container">
                    <div class="row">
                        <form action="/library/book/list-books-sidebar">
                            <div class="col-md-8 col-sm-12">
                                <input type="text" name="book_title" placeholder="<?= Yii::t('app', 'Enter book title...') ?>">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <button type="submit"><?= Yii::t('app', 'Search Book') ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="Publications">
                <div class="form-container">
                    <form action="/library/book/list-books-sidebar">
                        <div class="col-md-8 col-sm-12">
                            <input type="text" name="publisher" placeholder="<?= Yii::t('app', 'Enter publisher...') ?>">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <button><?= Yii::t('app', 'Search Publisher') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
