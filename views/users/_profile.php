<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\User $model */
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="<?= $model->avatarUrl ?>" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3"><?= $model->username ?></h5>
                        <p class="text-muted mb-1">ID: <?= $model->id ?></p>
                        <p class="text-muted mb-4"><?= $model->role ?></p>
                        <div class="d-flex justify-content-center mb-2">
                            <!-- <button type="button" class="btn btn-primary">Follow</button>
                            <button type="button" class="btn btn-outline-primary ms-1">Message</button> -->
                            <?php if (Yii::$app->user->can('admin')) : ?>
                                <?= Html::a('Editar', ['/users/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('Eliminar', ['/users/delete', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-danger ms-1',
                                    'data' => [
                                        'confirm' => '¿Estás seguro de que quieres eliminar este artículo?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            <?php endif ?>
                            <?php if (Yii::$app->user->identity->id == $model->id) : ?>
                                <a href="<?= Url::toRoute(['/site/settings']) ?>" class="btn btn-secondary ms-1">Actualizar</a>
                            <?php endif ?>
                            
                        </div>
                    </div>
                </div>
                <!-- <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fas fa-globe fa-lg text-warning"></i>
                            <p class="mb-0">https://mdbootstrap.com</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                            <p class="mb-0">@mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                        </ul>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class'=>''],
                            'template' => 
                                '<div class="row"><div{captionOptions}><p class="mb-0">{label}</p></div><div{contentOptions}><p class="text-muted mb-0">{value}</p></div></div><hr>'
                                // . '<tr><th{captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>'
                            ,
                            'attributes' => [
                                [
                                    'label' => 'Id del usuario',
                                    'value' => $model->id,
                                    'visible' => true,
                                    'captionOptions' => ['class' => 'col-sm-3'],
                                    'contentOptions' => ['class' => 'col-sm-9'],
                                ],
                                [
                                    'label' => 'Nombre de usuario',
                                    'value' => $model->username,
                                    'visible' => true,
                                    'captionOptions' => ['class' => 'col-sm-3'],
                                    'contentOptions' => ['class' => 'col-sm-9'],
                                ],
                                [
                                    'label' => 'API Key de Auth',
                                    'value' => $model->auth_key,
                                    'visible' => true,
                                    'captionOptions' => ['class' => 'col-sm-3'],
                                    'contentOptions' => ['class' => 'col-sm-9'],
                                ],
                                [
                                    'label' => 'Correo electronico',
                                    'value' => $model->email,
                                    'visible' => true,
                                    'captionOptions' => ['class' => 'col-sm-3'],
                                    'contentOptions' => ['class' => 'col-sm-9'],
                                ],
                                [
                                    'label' => 'Rol principal',
                                    'value' => $model->role,
                                    'visible' => true,
                                    'captionOptions' => ['class' => 'col-sm-3'],
                                    'contentOptions' => ['class' => 'col-sm-9'],
                                ],
                                [
                                    'label' => 'Estado',
                                    'value' => $model->status == User::STATUS_DELETED ? 'Inactivo' : ($model->status == User::STATUS_ACTIVE ? 'Activo' : 'Error'),
                                    'visible' => true,
                                    'captionOptions' => ['class' => 'col-sm-3'],
                                    'contentOptions' => ['class' => 'col-sm-9'],
                                ],
                                [
                                    'label' => 'Fecha de registro',
                                    'value' => date('d-m-Y H:i:s', $model->created_at),
                                    'visible' => true,
                                    'captionOptions' => ['class' => 'col-sm-3'],
                                    'contentOptions' => ['class' => 'col-sm-9'],
                                ],
                                [
                                    'label' => 'Ultima actualizacion',
                                    'value' => date('d-m-Y H:i:s', $model->updated_at),
                                    'visible' => true,
                                    'captionOptions' => ['class' => 'col-sm-3'],
                                    'contentOptions' => ['class' => 'col-sm-9'],
                                ],
                                // 'password_hash',
                                // 'password_reset_token',
                                // 'email:email',
                                // 'role',
                                // 'status',
                                // 'created_at',
                                // 'updated_at',
                                // 'verification_token',
                            ],
                        ]) ?>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                        <div class="card-body">
                            <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                            </p>
                            <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                            <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                            <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                            <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                            <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                            <div class="progress rounded mb-2" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                        <div class="card-body">
                            <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                            </p>
                            <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                            <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                            <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                            <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                            <div class="progress rounded" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                            <div class="progress rounded mb-2" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div> -->
            </div>
            </div>
        </div>
    </section>