<?php namespace backend\tests\models;

use yii\helpers\ArrayHelper;
use common\models\Questions;
use common\fixtures\UserFixture;
use FixtureTrait;
use common\models\User;

class QuestionsTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;


    public function testSaveQuestionSuccess()
    {
        $model = new Questions();
        $model->attributes = [
            'qname' => 'Test Question',

        ];
        expect_that($model->save());
    }

    public function testSaveQuestionFail()
    {
        $model = new Questions();
        $model->attributes = [
            'qname' => '',

        ];
        expect_not($model->save());
        expect_that($model->getErrors('qname'));
    }

    public function testUpdateQuestionSuccess()
    {
        $model = new Questions();

        $model->attributes = [
            'qname' => 'Question Before Update',
        ];
        $this->assertTrue($model->save());
        $id = $model->qid;
        $model = Questions::find()->where(['qid' => $id])->one();


        $this->assertTrue($model->qname === 'Question Before Update');


        $updatemodel = Questions::find()->where(['qid' => $id])->one();
        $updatemodel->qname='Question After Update';
        $this->assertTrue($updatemodel->save());
        $this->assertTrue($updatemodel->qname === 'Question After Update');
        $this->assertTrue($updatemodel->qid === $id);

    }

    public function testUpdateQuestionFail()
    {
        $model = new Questions();

        $model->attributes = [
            'qname' => 'Question Before Update Not Success',
        ];
        $this->assertTrue($model->save());



        $this->assertTrue($model->qname === 'Question Before Update Not Success');
        $id = $model->qid;

        $updatemodel = Questions::find()->where(['qid' => $id])->one();
        $updatemodel->qname='';
        $this->assertFalse($updatemodel->save());
        $updatemodel = Questions::find()->where(['qid' => $id])->one();
        $this->assertTrue($updatemodel->qname === 'Question Before Update Not Success');
         $this->assertTrue($updatemodel->qid === $id);

    }

    public function testDeleteQuestionSuccess()
    {
        $model = new Questions();

        $model->attributes = [
            'qname' => 'Question For Delete',
        ];
        $this->assertTrue($model->save());



        $this->assertTrue($model->qname === 'Question For Delete');
        $id = $model->qid;

        $deletemodel = Questions::find()->where(['qid' => $id])->one();
        $this->assertNotNull($deletemodel);
        expect_that($deletemodel->delete());
        $deletemodel = Questions::find()->where(['qid' => $id])->one();
        $this->assertNull($deletemodel);
    }


    public function testRetrieveQuestion()
    {
        $questionList = ArrayHelper::map(Questions::find()->all(), 'qid', 'qname');
        $this->assertEquals(3,count($questionList));
    }

    public function testRetrieveAnswersbyQid(){
        $id = 1;
        $model=new Questions();
        $model = Questions::find()->where(['qid' => $id])->one();
        $answerList = ArrayHelper::map($model->answers,'ansid', 'anscontent');
        $this->assertEquals(3,count($answerList));

        $id = 2;
        $model=new Questions();
        $model = Questions::find()->where(['qid' => $id])->one();
        $answerList = ArrayHelper::map($model->answers,'ansid', 'anscontent');
        $this->assertEquals(4,count($answerList));

        $id = 3;
        $model=new Questions();
        $model = Questions::find()->where(['qid' => $id])->one();
        $answerList = ArrayHelper::map($model->answers,'ansid', 'anscontent');
        $this->assertEquals(1,count($answerList));
    }
}