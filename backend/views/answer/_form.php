<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Answer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'qid')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\Questions::find()->all(),'qid','qname'),['prompt'=>'Select Question']

    ) ?>
    <?php /*= $form->field($model,'qname')->label()*/?>
    <?= $form->field($model, 'anscontent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'true' => 'True', 'false' => 'False', ], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
