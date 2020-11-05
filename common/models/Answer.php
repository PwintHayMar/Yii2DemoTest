<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%answer}}".
 *
 * @property int $ansid
 * @property string $anscontent
 * @property string $status
 * @property int $qid
 *
 * @property Questions $q
 */
class Answer extends \yii\db\ActiveRecord
{
        /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%answer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anscontent', 'status', 'qid'], 'required'],
            [['status'], 'string'],
            [['qid'], 'integer'],
            [['anscontent'], 'string', 'max' => 1000],
            [['qid'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['qid' => 'qid']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ansid' => 'Ansid',
            'anscontent' => 'Anscontent',
            'status' => 'Status',
            'qid' => 'Qid',
        ];
    }

    /**
     * Gets query for [[Q]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['qid' =>'qid']);
    }

    /*Getter for Question Content*/
   public function getQname(){
        return $this->questions->qname;
    }

}
