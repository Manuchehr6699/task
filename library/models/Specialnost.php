<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table "specialnost".
 *
 * @property int $specialnost_id
 * @property int $kafedra_id
 * @property string $spec_code
 * @property string $spec_tj
 * @property string $spec_ru
 * @property string $type
 * @property int $is_block
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Kafedra $kafedra
 */
class Specialnost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialnost';
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
            [['kafedra_id', 'is_block', 'created_by', 'updated_by'], 'integer'],
            [['spec_code', 'spec_tj', 'spec_ru', 'created_at', 'created_by'], 'required'],
            [['type'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['spec_code'], 'string', 'max' => 11],
            [['spec_tj', 'spec_ru'], 'string', 'max' => 100],
            [['kafedra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kafedra::className(), 'targetAttribute' => ['kafedra_id' => 'kafedra_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'specialnost_id' => Yii::t('book', 'Specialnost ID'),
            'kafedra_id' => Yii::t('book', 'Kafedra ID'),
            'spec_code' => Yii::t('book', 'Spec Code'),
            'spec_tj' => Yii::t('book', 'Spec Tj'),
            'spec_ru' => Yii::t('book', 'Spec Ru'),
            'type' => Yii::t('book', 'Type'),
            'is_block' => Yii::t('book', 'Is Block'),
            'created_at' => Yii::t('book', 'Created At'),
            'created_by' => Yii::t('book', 'Created By'),
            'updated_at' => Yii::t('book', 'Updated At'),
            'updated_by' => Yii::t('book', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKafedra()
    {
        return $this->hasOne(Kafedra::className(), ['kafedra_id' => 'kafedra_id']);
    }
}
