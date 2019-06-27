<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "book_category".
 *
 * @property int $category_id
 * @property string $category
 * @property int $is_top
 * @property int $is_block
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_category';
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
            [['is_top', 'is_block', 'parent_id'], 'integer'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('book', 'Category ID'),
            'parent_id' => Yii::t('book', 'Parent ID'),
            'category' => Yii::t('book', 'Category'),
            'is_top' => Yii::t('book', 'Is Top'),
            'is_block' => Yii::t('book', 'Is Block'),
        ];
    }
}
