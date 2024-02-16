<?php

use app\modules\sparking\models\Membership;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Membresiasa - Admin';
$this->params['breadcrumbs'][] = ['label' => 'SParking', 'url' => ['/sparking/default']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Nueva membresia', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
    
                    'id',
                    'name',
                    'type.name',
                    'price',
                    // 'duration:json',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Membership $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
