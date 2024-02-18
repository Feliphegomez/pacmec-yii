<?php

use app\models\Option;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\OptionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Create Option', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
            },
        ]) ?>
    </div>
</div>
