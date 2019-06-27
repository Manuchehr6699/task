<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $order_id
 * @property int $uid
 * @property int $naimen_id
 * @property int $book_id
 * @property string $order_date
 * @property string $confirm_date
 * @property int $confirm_by
 * @property int $status
 */
class Order extends \yii\db\ActiveRecord
{
    public $naimen;
    public $book_author;
    public $book_naimen_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'naimen_id'], 'required'],
            [['uid', 'naimen_id', 'book_id', 'confirm_by', 'status'], 'integer'],
            [['order_date', 'confirm_date', 'SID', 'naimen', 'book_author'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('book', 'Order ID'),
            'uid' => Yii::t('book', 'Uid'),
            'naimen_id' => Yii::t('book', 'Naimen ID'),
            'book_id' => Yii::t('book', 'Book ID'),
            'order_date' => Yii::t('book', 'Order Date'),
            'confirm_date' => Yii::t('book', 'Confirm Date'),
            'confirm_by' => Yii::t('book', 'Confirm By'),
            'naimen' => Yii::t('book', 'Naimen'),
            'book_author' => Yii::t('book', 'Book Author'),
            'book_naimen_id' => Yii::t('book', 'Book Id'),
            'status' => Yii::t('book', 'Status'),
            'SID' => Yii::t('book', 'Session ID'),
        ];
    }

}
