<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "book_main".
 *
 * @property string $flagIzmen isUpdated
 * @property string $flagIzYak
 * @property string $flagIzAgro
 * @property string $doc_id
 * @property int $doc_num
 * @property int $doc_year
 * @property int $book_id_start Book Start ID
 * @property int $book_naimen_id Naimen ID
 * @property int $lot_id
 * @property int $book_count Count
 * @property string $naimen Tittle
 * @property string $book_author Author
 * @property int $izdan Edition
 * @property int $soli_nashr Publish Date
 * @property int $nashriyot_id Publisher
 * @property int $joi_nashr_id Publish Place
 * @property int $count_page Count Page
 * @property int $book_language_id Book Language
 * @property string $format Format
 * @property string $ISBN ISBN
 * @property string $BBK BBK
 * @property string $UDK UDK
 * @property string $price_now Price now
 * @property string $price Price
 * @property string $photo Photo
 * @property int $cover_id Cover Type
 * @property int $cat_id Category
 * @property int $seriya_id Series
 * @property string $describe Description
 * @property string $cd CD
 * @property string $floppy Floppy
 * @property int $stilaz Stilazh
 * @property int $polka Shelf
 * @property int $is_block Is block
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class Book extends \yii\db\ActiveRecord
{
    public $joi_nashr;
    public $language;
    public $category;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_main';
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
            [['flagIzmen', 'flagIzYak', 'flagIzAgro', 'naimen', 'book_author', 'photo', 'describe', 'cd', 'floppy'], 'string'],
            [['doc_id', 'doc_num', 'doc_year', 'book_id_start', 'book_naimen_id', 'book_count', 'naimen', 'book_author', 'soli_nashr', 'nashriyot_id', 'joi_nashr_id', 'book_language_id', 'photo', 'cover_id', 'cat_id', 'seriya_id'], 'required'],
            [['doc_num', 'doc_year', 'book_id_start', 'book_naimen_id', 'lot_id', 'book_count', 'izdan', 'soli_nashr', 'nashriyot_id', 'joi_nashr_id', 'count_page', 'book_language_id', 'cover_id', 'cat_id', 'seriya_id', 'stilaz', 'polka', 'is_block', 'created_by', 'updated_by'], 'integer'],
            [['price_now', 'price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['doc_id'], 'string', 'max' => 9],
            [['format', 'ISBN', 'BBK', 'UDK'], 'string', 'max' => 30],
            [['book_id_start'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'flagIzmen' => Yii::t('book', 'isUpdated'),
            'flagIzYak' => Yii::t('book', 'Flag Iz Yak'),
            'flagIzAgro' => Yii::t('book', 'Flag Iz Agro'),
            'doc_id' => Yii::t('book', 'Doc ID'),
            'doc_num' => Yii::t('book', 'Doc Num'),
            'doc_year' => Yii::t('book', 'Doc Year'),
            'book_id_start' => Yii::t('book', 'Book Start ID'),
            'book_naimen_id' => Yii::t('book', 'Naimen ID'),
            'lot_id' => Yii::t('book', 'Lot ID'),
            'book_count' => Yii::t('book', 'Count'),
            'naimen' => Yii::t('book', 'Tittle'),
            'book_author' => Yii::t('book', 'Author'),
            'izdan' => Yii::t('book', 'Edition'),
            'soli_nashr' => Yii::t('book', 'Publish Date'),
            'nashriyot_id' => Yii::t('book', 'Publisher'),
            'joi_nashr_id' => Yii::t('book', 'Publish Place'),
            'count_page' => Yii::t('book', 'Count Page'),
            'book_language_id' => Yii::t('book', 'Book Language'),
            'format' => Yii::t('book', 'Format'),
            'ISBN' => Yii::t('book', 'ISBN'),
            'BBK' => Yii::t('book', 'BBK'),
            'UDK' => Yii::t('book', 'UDK'),
            'price_now' => Yii::t('book', 'Price now'),
            'price' => Yii::t('book', 'Price'),
            'photo' => Yii::t('book', 'Photo'),
            'cover_id' => Yii::t('book', 'Cover Type'),
            'cat_id' => Yii::t('book', 'Category'),
            'seriya_id' => Yii::t('book', 'Series'),
            'describe' => Yii::t('book', 'Description'),
            'cd' => Yii::t('book', 'CD'),
            'floppy' => Yii::t('book', 'Floppy'),
            'stilaz' => Yii::t('book', 'Stilazh'),
            'polka' => Yii::t('book', 'Shelf'),
            'is_block' => Yii::t('book', 'Is block'),
            'created_at' => Yii::t('book', 'Created At'),
            'created_by' => Yii::t('book', 'Created By'),
            'updated_at' => Yii::t('book', 'Updated At'),
            'updated_by' => Yii::t('book', 'Updated By'),
        ];
    }
}
