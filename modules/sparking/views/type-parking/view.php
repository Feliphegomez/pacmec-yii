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
                    'confirm' => '¿Estás seguro de que quieres eliminar este artículo?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?php 
            // DetailView::widget([
            //     'model' => $model,
            //     'attributes' => [
            //         'id',
            //         'name',
            //         // 'prices',
            //         // 'prices[f][price]',
            //         // 'prices[s][price]',
            //         // 'prices[i][price]',
            //         // 'prices[h][price]',
            //         // 'prices[d][price]',
            //         // 'prices[m][price]',
            //         // 'prices[y][price]',
            //         [
            //             'label' => 'Cobros',
            //             'value' => function($model) {
            //                 return json_encode($model->prices);
            //             },
            //         ],
            //     ],
            // ])
        ?>

        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">Fracción</h6>
                    <small><?= "{$model->prices['f']['price']} por cada {$model->prices['f']['f']}; despues de {$model->prices['f']['max']} se cobra el siguiente." ?></small>
                </div>
                <span class="text-body-secondary"><?= $model->prices['f']['price'] ?> x f</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">Segundos</h6>
                    <small><?= "{$model->prices['s']['price']} por cada {$model->prices['s']['f']}; despues de {$model->prices['s']['max']} se cobra el siguiente." ?></small>
                </div>
                <span class="text-body-secondary"><?= $model->prices['s']['price'] ?> x f</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">Minutos</h6>
                    <small><?= "{$model->prices['i']['price']} por cada {$model->prices['i']['f']}; despues de {$model->prices['i']['max']} se cobra el siguiente." ?></small>
                </div>
                <span class="text-body-secondary"><?= $model->prices['i']['price'] ?> x f</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">Horas</h6>
                    <small><?= "{$model->prices['h']['price']} por cada {$model->prices['h']['f']}; despues de {$model->prices['h']['max']} se cobra el siguiente." ?></small>
                </div>
                <span class="text-body-secondary"><?= $model->prices['h']['price'] ?> x f</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">Dias</h6>
                    <small><?= "{$model->prices['d']['price']} por cada {$model->prices['d']['f']}; despues de {$model->prices['d']['max']} se cobra el siguiente." ?></small>
                </div>
                <span class="text-body-secondary"><?= $model->prices['d']['price'] ?> x f</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">Meses</h6>
                    <small><?= "{$model->prices['m']['price']} por cada {$model->prices['m']['f']}; despues de {$model->prices['m']['max']} se cobra el siguiente." ?></small>
                </div>
                <span class="text-body-secondary"><?= $model->prices['m']['price'] ?> x f</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">Años</h6>
                    <small><?= "{$model->prices['y']['price']} por cada {$model->prices['y']['f']}." ?></small>
                </div>
                <span class="text-body-secondary"><?= $model->prices['y']['price'] ?> x f</span>
            </li>
        </ul>
    </div>
</div>
