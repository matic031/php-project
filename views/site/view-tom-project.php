<!-- view-tom-project.php -->
<?php
use yii\helpers\Html;
?>

<h1>Tom Project: <?= Html::encode($model->name) ?></h1>

<p>
    <?= Html::a('Update', ['update-tom-project', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete-tom-project', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?= $model->id ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?= Html::encode($model->name) ?></td>
    </tr>
    <!-- Add more fields as needed -->
</table>
