<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 06.01.2019
 * Time: 17:44
 */

namespace app\modules\library\models;
use app\modules\library\models\Book;
use Yii;

class System extends Book
{
    public $nashriyot;
    public $spec_code;
    public $discipline_id;
    public $language;

    public function rules()
    {
        return [
            [['flagIzmen', 'flagIzYak', 'flagIzAgro', 'naimen', 'book_author', 'photo', 'describe', 'cd', 'floppy'], 'string'],
            [['doc_id', 'doc_num', 'doc_year', 'book_id_start', 'book_naimen_id', 'book_count', 'naimen', 'book_author', 'soli_nashr', 'nashriyot_id', 'joi_nashr_id', 'book_language_id', 'photo', 'cover_id', 'cat_id', 'seriya_id'], 'required'],
            [['doc_num', 'doc_year', 'book_id_start', 'book_naimen_id', 'lot_id', 'book_count', 'izdan', 'soli_nashr', 'nashriyot_id', 'joi_nashr_id', 'count_page', 'book_language_id', 'cover_id', 'cat_id', 'seriya_id', 'stilaz', 'polka', 'is_block', 'created_by', 'updated_by'], 'integer'],
            [['price_now', 'price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['doc_id'], 'string', 'max' => 9],
            [['format', 'ISBN', 'BBK', 'UDK', 'spec_code', 'discipline_id'], 'string', 'max' => 30],
            [['discipline_id', 'nashriyot', 'language'], 'string', 'max' => 255],
            [['book_id_start'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nashriyot' => Yii::t('book', 'Publisher'),
            'language' => Yii::t('book', 'Language'),
            'spec_code' => Yii::t('book', 'Specialnost'),
            'discipline_id' => Yii::t('book', 'Discipline'),
            'flagIzmen' => Yii::t('book', 'isUpdated'),
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
            'soli_nashr' => Yii::t('book', 'Publish Year'),
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