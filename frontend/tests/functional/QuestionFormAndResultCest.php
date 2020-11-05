<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;
use common\models\Answer;
use common\models\Questions;

class QuestionFormAndResultCest
{
    public function _before(FunctionalTester $I)
    {

    }

    // tests
    public function checkQuestionForm(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        foreach (Questions::find()->all() as $targetQuestion)
        {

            $I->see($targetQuestion->qname);
            foreach($targetQuestion->answers as $targetAnswer) {
                $I->see($targetAnswer->anscontent);
            }
        }
    }


    public function checkResult(FunctionalTester $I){
        $I->amOnRoute('site/index');
        $I->submitForm('#question-form', ['Questions' => [1=>0,2=>7,3=>11]],'submit');
        $I->see('Result Page');
        $I->see('Your result is');
        $I->see('Number of Questions : 3');
        $I->see('Correct Answers : 1');
        $I->see('Uncorrect Answers : 2');

    }
}
