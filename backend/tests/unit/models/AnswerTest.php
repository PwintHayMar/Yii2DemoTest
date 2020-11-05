<?php namespace backend\tests\models;

use common\models\Answer;
use common\models\Questions;
use yii\helpers\ArrayHelper;

class AnswerTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSaveAnswerSuccess()
    {
        $model = new Answer();
        $model->attributes = [
            'qname' => 'Test Question',

            'anscontent' => 'Test Answer',
            'status' => 'true',
            'qid' => '1',

        ];
        expect_that($model->save());
    }

    public function testSaveAnswerFailbyAnscontent()
    {
        $model = new Answer();
        $model->attributes = [
            'anscontent' => '',
            'status' => 'true',
            'qid' => '1',

        ];
        expect_not($model->save());
        expect_that($model->getErrors('anscontent'));
    }

    public function testSaveAnswerFailbyStatus()
    {
        $model = new Answer();
        $model->attributes = [
            'anscontent' => 'Test Question',
            'status' => '',
            'qid' => '1',

        ];
        expect_not($model->save());
        expect_that($model->getErrors('status'));
    }

    public function testSaveAnswerFailbyQid()
    {
        $model = new Answer();
        $model->attributes = [
            'anscontent' => 'Test Question',
            'status' => 'false',
            'qid' => '',

        ];
        expect_not($model->save());
        expect_that($model->getErrors('qid'));
    }

    public function testUpdateAnswerSuccess()
    {
        $model = new Answer();
        $model->attributes = [
            'anscontent' => 'anscontent before update',
            'status' => 'true',
            'qid' => '1',

        ];
        $this->assertTrue($model->save());
        $this->assertTrue($model->anscontent === 'anscontent before update');
        $this->assertTrue($model->status === 'true');
        $this->assertTrue($model->qid === '1');
        $id = $model->ansid;
        $updatemodel = Answer::find()->where(['ansid' => $id])->one();
        $updatemodel->anscontent = 'anscontent After update';
        $updatemodel->status = 'false';
        $updatemodel->qid = 3;
        $this->assertTrue($updatemodel->save());
        $updatemodel = Answer::find()->where(['ansid' => $id])->one();
        $this->assertTrue($updatemodel->anscontent === 'anscontent After update');
        $this->assertTrue($updatemodel->status === 'false');
        $this->assertTrue($updatemodel->qid === 3);
        $this->assertTrue($updatemodel->ansid === $id);
    }

    public function testUpdateAnswerFailbyAnsContent()
    {
        $model = new Answer();
        $model->attributes = [
            'anscontent' => 'anscontent before update',
            'status' => 'true',
            'qid' => '1',

        ];
        $this->assertTrue($model->save());
        $this->assertTrue($model->anscontent === 'anscontent before update');
        $this->assertTrue($model->status === 'true');
        $this->assertTrue($model->qid === '1');
        $id = $model->ansid;
        $updatemodel = Answer::find()->where(['ansid' => $id])->one();
        $updatemodel->anscontent = '';
        $updatemodel->status = 'false';
        $updatemodel->qid = 3;
        $this->assertFalse($updatemodel->save());
        $updatemodel = Answer::find()->where(['ansid' => $id])->one();
        $this->assertTrue($updatemodel->anscontent === 'anscontent before update');
        $this->assertTrue($updatemodel->status === 'true');
        $this->assertTrue($updatemodel->qid === 1);
        $this->assertTrue($updatemodel->ansid === $id);
    }

    public function testUpdateAnswerFailbyStatus()
    {
        $model = new Answer();
        $model->attributes = [
            'anscontent' => 'anscontent before update',
            'status' => 'true',
            'qid' => '1',

        ];
        $this->assertTrue($model->save());
        $this->assertTrue($model->anscontent === 'anscontent before update');
        $this->assertTrue($model->status === 'true');
        $this->assertTrue($model->qid === '1');
        $id = $model->ansid;
        $updatemodel = Answer::find()->where(['ansid' => $id])->one();
        $updatemodel->anscontent = 'anscontent After update';
        $updatemodel->status = '';
        $updatemodel->qid = 3;
        $this->assertFalse($updatemodel->save());
        $updatemodel = Answer::find()->where(['ansid' => $id])->one();
        $this->assertTrue($updatemodel->anscontent === 'anscontent before update');
        $this->assertTrue($updatemodel->status === 'true');
        $this->assertTrue($updatemodel->qid === 1);
        $this->assertTrue($updatemodel->ansid === $id);
    }

    public function testUpdateAnswerFailbyQid()
    {
        $model = new Answer();
        $model->attributes = [
            'anscontent' => 'anscontent before update',
            'status' => 'true',
            'qid' => '1',

        ];
        $this->assertTrue($model->save());
        $this->assertTrue($model->anscontent === 'anscontent before update');
        $this->assertTrue($model->status === 'true');
        $this->assertTrue($model->qid === '1');
        $id = $model->ansid;
        $updatemodel = Answer::find()->where(['ansid' => $id])->one();
        $updatemodel->anscontent = 'anscontent After update';
        $updatemodel->status = 'false';
        $updatemodel->qid = '';
        $this->assertFalse($updatemodel->save());
        $updatemodel = Answer::find()->where(['ansid' => $id])->one();
        $this->assertTrue($updatemodel->anscontent === 'anscontent before update');
        $this->assertTrue($updatemodel->status === 'true');
        $this->assertTrue($updatemodel->qid === 1);
        $this->assertTrue($updatemodel->ansid === $id);
    }

    public function testDeleteAnswerSuccess()
    {
        $model = new Answer();
        $model->attributes = [
            'anscontent' => 'anscontent before delete',
            'status' => 'true',
            'qid' => '1',

        ];
        $this->assertTrue($model->save());
        $id = $model->ansid;
        $model = Answer::find()->where(['ansid' => $id])->one();
        $this->assertTrue($model->anscontent === 'anscontent before delete');
        $this->assertTrue($model->status === 'true');
        $this->assertTrue($model->qid === 1);
        $id = $model->ansid;
        $deletemodel = Answer::find()->where(['ansid' => $id])->one();
        $this->assertNotNull($deletemodel);
        expect_that($deletemodel->delete());
        $deletemodel = Answer::find()->where(['ansid' => $id])->one();
        $this->assertNull($deletemodel);

    }

    public function testRetrieveAnswer()
    {
        $answerList = ArrayHelper::map(Answer::find()->all(), 'ansid', 'anscontent');
        $this->assertEquals(8, count($answerList));
    }

    public function testGetQname()
    {
        $answer = Answer::find()->where(['ansid' => 1])->one();
        $this->assertEquals($answer->getQname(),'Which one of the following is used to define the structure of the relation, deleting relations and relating schemas?');
    }
}