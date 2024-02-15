<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\sparking\models\TypeParking $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = ['label' => 'Tipos de estacionamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="type-parking-view">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                // 'prices',
                // 'prices[f][price]',
                // 'prices[s][price]',
                // 'prices[i][price]',
                // 'prices[h][price]',
                // 'prices[d][price]',
                // 'prices[m][price]',
                // 'prices[y][price]',
                [
                    'label' => 'Cobros',
                    'value' => function($model) {
                        return json_encode($model->prices);
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
