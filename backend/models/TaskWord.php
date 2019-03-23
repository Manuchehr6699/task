<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "task_word".
 *
 * @property int $word_id
 * @property int $sentence_id Sentence
 * @property string $word
 * @property int $is_block
 */
class TaskWord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sentence_id', 'is_block'], 'integer'],
            [['word'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'word_id' => 'Word ID',
            'sentence_id' => 'Sentence ID',
            'word' => 'Word',
            'is_block' => 'Is Block',
        ];
    }
}
