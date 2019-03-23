<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "task_sentence".
 *
 * @property int $sentence_id
 * @property int $text_id Text
 * @property string $senctence
 * @property int $is_block
 */
class TaskSentence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_sentence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text_id', 'is_block'], 'integer'],
            [['senctence'], 'string', 'max' => 255],
            [['senctence'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sentence_id' => 'Sentence ID',
            'text_id' => 'Text ID',
            'senctence' => 'Senctence',
            'is_block' => 'Is Block',
        ];
    }
}
