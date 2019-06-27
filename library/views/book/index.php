<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\library\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('book', 'System search book');
$this->params['breadcrumbs'][] = $this->title;
?>


<?php echo $this->render('/book/banners/sistematic-search', ['model' => $searchModel]) ?>

<div class="col-xs-12">
    <div class="book-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header' => '№'
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'naimen',
                    'format' => 'raw',
                    'width' => '25%',
                    'vAlign'=>'middle',
                    'value' => function($model) {
                        return '<p class="link">'.Html::a($model->naimen, ['/library/book/view-book-details/?id='.$model->book_naimen_id], [
                                'data-pjax' => 0,
                                'target' => '_blank'
                            ]).'</p>';
                    },
                    'readonly' => function($model, $key, $index, $widget) {
                        return (true);//(!$model->status);
                    },
                ],
                [
                    'attribute' => 'book_author',
                    'value' => function ($model) {
                        if (empty($model->book_author)) {
                            return '----';
                        } else {
                            return $model->book_author;
                        }
                    }
                ],
                [
                    'attribute' => 'nashriyot',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(\app\modules\admin\modules\bookdetail\models\BookNashriyot::find()->where(['is_block' => 0])
                        ->orderBy('nashriyot')->asArray()->all(), 'nashriyot', 'nashriyot'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['multiple' => false]
                    ],
                    'filterInputOptions' => ['placeholder' => Yii::t('app', '--- Select Publisher ---')],
                ],
                [
                    'attribute' => 'soli_nashr',
                ],
                [
                    'attribute' => 'language',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(\app\modules\admin\modules\bookdetail\models\BookLanguage::find()->where(['is_block' => 0])
                        ->orderBy('language_id')->asArray()->all(), 'language', 'language'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['multiple' => false]
                    ],
                    'filterInputOptions' => ['placeholder' => Yii::t('app', '--- Select Language ---')],
                ],
                [
                    'attribute' => 'book_count',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{order}{like}',
                    'buttons' => [
                        'order' => function ($url, $model) {
                            if ($model->book_count > 1 && !Yii::$app->user->isGuest) {
                                return Html::a('<span class="fa fa-book"></span>', \yii\helpers\Url::to(['/library/order/add', 'id' => $model->book_naimen_id]), ['title' => Yii::t('app', 'Add to order'), 'class' => 'add-to-cart', 'data-id' => $model->book_naimen_id]);
                            }
                        },
                        'like' => function ($url, $model) {
                            if (!Yii::$app->user->isGuest) {
                                $l = \app\modules\library\models\LikeBook::find()
                                    ->where(['user_id' => Yii::$app->getuserinfo->getId()])
                                    ->andWhere(['book_naimen_id' => $model->book_naimen_id])
                                    ->andWhere(['book_type' => 'O'])->asArray()->one();
                                if (!empty($l)):
                                    return '<div class="rating">' . Html::a('<span class="add-to-like like" data-id="' . $model->book_naimen_id . '"><i
                                                        class="fa fa-heart"></i></span>', '', ['title' => Yii::t('app', 'Add to favorite'),]) . '</div><div id="likecount' . $model->book_naimen_id . '"
                                         style="color: black; font-weight: bold;"></div>';
                                else:
                                    return '<div class="rating">' . Html::a('<span class="add-to-like" data-id="' . $model->book_naimen_id . '"><i
                                                        class="fa fa-heart"></i></span>', '', ['title' => Yii::t('app', 'Add to favorite'),]) . '</div><div id="likecount' . $model->book_naimen_id . '"
                                         style="color: black; font-weight: bold;"></div>';
                                endif;
                            }
                        }
                    ],
                ],
            ],
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'panel' => [
                        'type' => GridView::TYPE_INFO,
                        'heading' => Yii::t('book', 'Books'),
                    ],
                    'export' => false,
                    'summary' => false,
                    'persistResize' => false,
                    'itemLabelSingle' => Yii::t('book','book'),
                    'itemLabelPlural' => Yii::t('book','books')
        ]); ?>
    </div>
</div>
