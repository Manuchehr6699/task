<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "book_discipline".
 *
 * @property int $book_dis_id
 * @property int $naimen_id
 * @property int $discipline_id
 * @property int $book_id_start
 * @property int $is_block
 *
 * @property Discipline $discipline
 */
class BookDiscipline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_discipline';
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
            [['naimen_id', 'discipline_id', 'book_id_start', 'is_block'], 'integer'],
            [['discipline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['discipline_id' => 'discipline_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_dis_id' => Yii::t('book', 'Book Dis ID'),
            'naimen_id' => Yii::t('book', 'Naimen ID'),
            'discipline_id' => Yii::t('book', 'Discipline ID'),
            'book_id_start' => Yii::t('book', 'Book Id Start'),
            'is_block' => Yii::t('book', 'Is Block'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['discipline_id' => 'discipline_id']);
    }
}
