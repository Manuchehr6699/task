<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "discipline".
 *
 * @property int $discipline_id
 * @property int $dis_cat_id
 * @property string $discipline_name
 * @property int $is_block
 *
 * @property BookDiscipline[] $bookDisciplines
 * @property DisciplineCategory $disCat
 */
class Discipline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discipline';
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
            [['dis_cat_id', 'is_block'], 'integer'],
            [['discipline_name'], 'string', 'max' => 255],
            [['dis_cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisciplineCategory::className(), 'targetAttribute' => ['dis_cat_id' => 'dis_cat_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'discipline_id' => Yii::t('book', 'Discipline ID'),
            'dis_cat_id' => Yii::t('book', 'Dis Cat ID'),
            'discipline_name' => Yii::t('book', 'Discipline Name'),
            'is_block' => Yii::t('book', 'Is Block'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookDisciplines()
    {
        return $this->hasMany(BookDiscipline::className(), ['discipline_id' => 'discipline_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisCat()
    {
        return $this->hasOne(DisciplineCategory::className(), ['dis_cat_id' => 'dis_cat_id']);
    }
}
