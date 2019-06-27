<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 06.01.2019
 * Time: 22:51
 */
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = Yii::t('univer', 'My Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $this->render('/order/banners/my-order-list'); ?>

<div class="col-xs-12">
    <div class="book-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function($model){
                        if($model->status != 0){
                            return ['style' => 'background-color: #9DF13D;'];
                        }
                        },
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header' => '№'
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'naimen',
                    'format' => 'raw',
                    'header' => Yii::t('book', 'Title'),
                    'width' => '25%',
                    'filter' => false,
                    'vAlign'=>'middle',
                    'value' => function($model) {
                        return '<p class="link">'.Html::a($model->naimen, ['/library/book/view-book-details/?id='.$model->book_naimen_id], [
                                'data-pjax' => 0,
                                'target' => '_blank'
                            ]).'</p>';
                    },
                    'readonly' => function($model, $key, $index, $widget) {
                        return (true);
                    },
                ],
                [
                    'attribute' => 'book_author',
                    'header' => Yii::t('book', 'Book Author'),
                    'filter' => false,
                    'value' => function ($model) {
                        if (empty($model->book_author)) {
                            return '----';
                        } else {
                            return $model->book_author;
                        }
                    }
                ],
                [
                    'attribute' => 'order_date',
                    'filter' => false,
                    'value' => function ($model) {
                        if (empty($model->order_date)) {
                            return '----';
                        } else {
                            return $model->order_date;
                        }
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            if($model->status == 0)
                            return Html::a('<i class="ace-icon fa fa-trash-o bigger-120"></i>', '/library/order/delete?id='.$model->book_naimen_id, ['title' => Yii::t('app', 'Delete'), 'aria-label' => Yii::t('app', 'Delete'), 'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method' => 'post', 'class'=>'btn btn-xs btn-danger']);
                        },
                    ],
                ],
            ],
            'bordered' => true,
            'striped' => false,
            'condensed' => false,
            'responsive' => true,
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => Yii::t('univer', 'My Orders'),
            ],
            'export' => false,
            'summary' => false,
            'persistResize' => false
        ]); ?>
    </div>
</div>
