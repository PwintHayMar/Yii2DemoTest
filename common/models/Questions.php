<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%questions}}".
 *
 * @property int $qid
 * @property string $qname
 *
 * @property Answer[] $answers
 */
class Questions extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%questions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qname'], 'required'],
            [['qname'], 'string', 'max' => 1000],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'qid' => 'Qid',
            'qname' => 'Qname',
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['qid' => 'qid']);
    }
}
