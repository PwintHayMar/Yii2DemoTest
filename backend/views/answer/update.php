<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Answer */

$this->title = 'Update Answer: ' . $model->ansid;
$this->params['breadcrumbs'][] = ['label' => 'Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ansid, 'url' => ['view', 'id' => $model->ansid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
