<?php

namespace app\modules\sparking\controllers;

use Yii;
use app\modules\sparking\models\Movements;
use app\modules\sparking\models\MovementsSearch;
use app\modules\sparking\models\Menus;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MovementsController implements the CRUD actions for Movements model.
 */
class MovementsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Movements models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MovementsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
		// $dataProvider->pagination->pageSize = 100000;
		$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        Menus::addMenuParking();
    }

    /**
     * Displays a single Movements model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Movements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Movements();
        $model->check_in = date('Y-m-d h:i:s');
        $model->check_in_user_id = Yii::$app->user->identity->id;
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->check_out == null  && $model->save()) return $this->redirect(['view', 'id' => $model->id]);
                else {

                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Movements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // $model = $this->findModel($id);
        // $model->check_out = date('Y-m-d h:i:s');
        // $model->check_out_user_id = Yii::$app->user->identity->id;

        // // Crear objetos DateTime con los timestamps
        // $fechaIngreso = new \DateTime("$model->check_in");
        // $fechaSalida = new \DateTime("$model->check_out");

        // // Calcular la diferencia entre las fechas
        // $diferencia = $fechaIngreso->diff($fechaSalida);

        // $model->time_elapsed = $diferencia;

        // $model->payment_value = 0;

        // // $model->payment_value += $diferencia->days * $model->type->prices['d'];
        // // $model->payment_value += $diferencia->h * $model->type->prices['h'];
        // // $model->payment_value += $diferencia->i * $model->type->prices['i'];
        // // $model->payment_value += $diferencia->s * $model->type->prices['s'];

        // if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Deletes an existing Movements model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Movements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Movements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movements::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
