<?php

use app\modules\sparking\models\TypeParking;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tipos de estacionamientos - Admin';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-parking-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Nuevo tipo de parking', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

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
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, TypeParking $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
