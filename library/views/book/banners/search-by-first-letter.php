<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 01.01.2019
 * Time: 9:35
 */

use app\modules\admin\modules\ourbook\models\BookMain;

?>
<!--BANNER START-->
<div class="kode-inner-banner">
    <div class="kode-page-heading">
        <h2><?= Yii::t('univer', 'Search By First Letter') ?></h2>
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>
<!--BANNER END-->
<div class="search-section" style="background-color: grey">
    <div class="container">
        <div class="tab-content">
            <div class="form-container">
                <div class="row">
                    <?php
                    echo "<table align='center' style='color: white; border: none'>";
                    echo "<tr><th colspan='14' style='color: white; border: none'><center>";
                    for ($i = 0; $i <= 35; $i++) {
                        $kol = BookMain::find()
                            ->innerJoin('book b', 'b.naimen_id = book_main.book_naimen_id')
                            ->where(['like', 'naimen', $rusLet[$i] . '%', false])
                            ->andWhere(['book_main.is_block' => 0])->count();
                        if ($kol > 0) {
                            if(!empty($rusLet[$i]))
                                echo "<a class='btn btn-default btn-sm' href='". \yii\helpers\Url::to(['/library/book/search-by-first-letter', 'letter' => $rusLet[$i]])."'>{$rusLet[$i]}</a>";
                        } else {
                            echo "<a class='btn btn-default disabled  btn-sm' href='#'>{$rusLet[$i]}</a>";
                        }
                    }
                    echo "</center></th></tr>";

                    //----------------------------------------------------------------------------------

                    echo "<tr><th colspan='14' style='color: white; border: none'><center>";
                    for ($i = 0; $i <= 25; $i++) {
                        $kol = BookMain::find()
                            ->innerJoin('book b', 'b.naimen_id = book_main.book_naimen_id')
                            ->where(['like', 'naimen', $engLet[$i] . '%', false])
                            ->andWhere(['book_main.is_block' => 0])->count();
                        if ($kol > 0) {
                            if(!empty($engLet[$i]))
                                echo "<a class='btn btn-default btn-sm' href='". \yii\helpers\Url::to(['/library/book/search-by-first-letter', 'letter' => $engLet[$i]])."'>{$engLet[$i]}</a>";
                        } else {
                            echo "<a class='btn btn-default disabled  btn-sm' href='#'>{$engLet[$i]}</a>";
                        }
                    }
                    echo "</center></th></tr>";

                    ////----------------------------------------------------------------------------------
                    echo "<tr><th colspan='14' style='color: white; border: none'><center>";

                    $kol = BookMain::find()
                        ->innerJoin('book b', 'b.naimen_id = book_main.book_naimen_id')
                        ->where("book_main.naimen REGEXP '^[0-9]'")
                        ->orWhere("book_main.naimen REGEXP '^[\"\'.,!~`@#$%^&*<>_-]'")
                        ->andWhere(['book_main.is_block' => 0])->count();
                    if ($kol > 0) {
                        echo "<center><a href='/library/book/search-by-first-letter?letter=*' style='color:white; font-size: 14px;'>". Yii::t('univer', 'All simbols and numbers') ."</a></center>";
                    } else {
                        echo "<center><span style='font-size: 14px;'>". Yii::t('univer', 'All simbols and numbers') ."</span></center>";
                    }
                    echo "</center></th></tr>";
                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
