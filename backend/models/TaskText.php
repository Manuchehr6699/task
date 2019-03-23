<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "task_text".
 *
 * @property int $text_id
 * @property string $text
 * @property int $is_block
 * @property string $created_at
 * @property int $created_by
 */
class TaskText extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_text';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['text'], 'required'],
            [['is_block', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'text_id' => 'Text ID',
            'text' => 'Text',
            'is_block' => 'Is Block',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
