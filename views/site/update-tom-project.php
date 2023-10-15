<!-- update-tom-project.php -->

<?php
use yii\helpers\Html;
?>

<h1>Update Tom Project: <?= Html::encode($model->name) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
