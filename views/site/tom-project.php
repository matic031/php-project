<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Tom Projects';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create Tom Project', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider, // Use the provided data provider
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('View', ['view-tom-project', 'id' => $model->id], ['class' => 'btn btn-primary']);
                },
                'update' => function ($url, $model, $key) {
                    return Html::a('Update', ['update-tom-project', 'id' => $model->id], ['class' => 'btn btn-warning']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('Delete', ['delete-tom-project', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]);
                },
            ],
        ],
    ],
]);
