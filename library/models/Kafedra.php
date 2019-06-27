<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "kafedra".
 *
 * @property int $kafedra_id
 * @property string $kafedra_taj
 * @property string $kafedra_rus
 * @property string $kafedra_en
 * @property int $fakultet_id
 * @property string $kafedra_sokr_taj
 * @property string $kafedra_sokr_rus
 * @property string $kafedra_sokr_en
 * @property string $status_of_kaf
 *
 * @property Specialnost[] $specialnosts
 */
class Kafedra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kafedra';
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
            [['fakultet_id'], 'integer'],
            [['kafedra_taj', 'kafedra_rus', 'kafedra_en', 'kafedra_sokr_taj', 'kafedra_sokr_rus', 'kafedra_sokr_en'], 'string', 'max' => 255],
            [['status_of_kaf'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kafedra_id' => Yii::t('book', 'Kafedra ID'),
            'kafedra_taj' => Yii::t('book', 'Kafedra Taj'),
            'kafedra_rus' => Yii::t('book', 'Kafedra Rus'),
            'kafedra_en' => Yii::t('book', 'Kafedra En'),
            'fakultet_id' => Yii::t('book', 'Fakultet ID'),
            'kafedra_sokr_taj' => Yii::t('book', 'Kafedra Sokr Taj'),
            'kafedra_sokr_rus' => Yii::t('book', 'Kafedra Sokr Rus'),
            'kafedra_sokr_en' => Yii::t('book', 'Kafedra Sokr En'),
            'status_of_kaf' => Yii::t('book', 'Status Of Kaf'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialnosts()
    {
        return $this->hasMany(Specialnost::className(), ['kafedra_id' => 'kafedra_id']);
    }
}
