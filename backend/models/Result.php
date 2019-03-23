<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property int $result_id
 * @property int $user_id User
 * @property int $sentence_id Answer
 * @property string $type
 * @property int $is_block
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sentence_id', 'is_block'], 'integer'],
            [['type'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'result_id' => 'Result ID',
            'user_id' => 'User ID',
            'sentence_id' => 'Sentence ID',
            'type' => 'Type',
            'is_block' => 'Is Block',
        ];
    }
}
