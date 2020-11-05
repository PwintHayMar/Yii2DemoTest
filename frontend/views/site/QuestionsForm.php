<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Questions */
/* @var $form ActiveForm */
?>
<div class="QuestionsForm">

    <?php $form = ActiveForm::begin(['id' => 'question-form']); ?>
     <?php $count=1; ?>
    <?php foreach(\common\models\Questions::find()->all() as $question) {?>

        <?php foreach($model as $model_item) { ?>

            <p><?= $count++.'.'?><?= $question->qname?></p>

            <?= $form->field($model_item, 'answers')->radioList(ArrayHelper::map($question->answers, 'ansid', 'anscontent'),['name'=>'Questions['.$question->qid.']','separator'=>'<br>'])?>

        <?php } }?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary','value'=>'result_submit','name'=>'submit']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- QuestionsForm -->
