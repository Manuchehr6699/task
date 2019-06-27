<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "discipline_category".
 *
 * @property int $dis_cat_id
 * @property string $dis_cat_name
 * @property int $is_block
 * @property int $book_id_start
 *
 * @property Discipline[] $disciplines
 */
class DisciplineCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discipline_category';
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
            [['is_block', 'book_id_start'], 'integer'],
            [['dis_cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dis_cat_id' => Yii::t('book', 'Dis Cat ID'),
            'dis_cat_name' => Yii::t('book', 'Dis Cat Name'),
            'is_block' => Yii::t('book', 'Is Block'),
            'book_id_start' => Yii::t('book', 'Book Id Start'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplines()
    {
        return $this->hasMany(Discipline::className(), ['dis_cat_id' => 'dis_cat_id']);
    }
}
