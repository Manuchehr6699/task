<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "book_spec".
 *
 * @property int $book_spec_id
 * @property string $spec_code
 * @property int $naimen_id
 * @property int $lot_id
 * @property int $is_block
 */
class BookSpecialty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_spec';
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
            [['book_spec_id'], 'required'],
            [['book_spec_id', 'naimen_id', 'lot_id', 'status'], 'integer'],
            [['spec_code'], 'string', 'max' => 10],
            [['book_spec_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_spec_id' => Yii::t('book', 'Book Spec ID'),
            'spec_code' => Yii::t('book', 'Spec Code'),
            'naimen_id' => Yii::t('book', 'Naimen ID'),
            'lot_id' => Yii::t('book', 'Lot ID'),
            'status' => Yii::t('book', 'Is Block'),
        ];
    }
}
