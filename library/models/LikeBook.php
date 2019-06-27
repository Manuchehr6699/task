<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "liked_books".
 *
 * @property int $like_id
 * @property int $book_naimen_id
 * @property int $user_id
 * @property string $book_type
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Ebook $bookNaimen
 */
class LikeBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'liked_books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_naimen_id', 'user_id', 'status'], 'integer'],
            [['book_type'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'like_id' => Yii::t('book', 'Like ID'),
            'book_naimen_id' => Yii::t('book', 'Book Naimen ID'),
            'user_id' => Yii::t('book', 'User ID'),
            'book_type' => Yii::t('book', 'Book Type'),
            'status' => Yii::t('book', 'Status'),
            'created_at' => Yii::t('book', 'Created At'),
            'updated_at' => Yii::t('book', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
}
