<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Questions */
/* @var $form ActiveForm */
?>
<div class="resultview">

    <?php $form = ActiveForm::begin(); ?>

    <center><h1>Result Page</h1></center>
    <p>Your result is</p>
    <?php
    echo "<p>Number of Questions : ".$totalCount."</p>";

    echo "<p>Correct Answers : ".$trueCount."</p>";

    echo "<p>Uncorrect Answers : ".$falseCount."</p>";
    ?>
    <?php ActiveForm::end(); ?>



</div><!-- resultview -->
