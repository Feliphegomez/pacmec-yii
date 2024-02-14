<?php 
namespace app\modules\sparking\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * Displays ingreso-vehiculo.
     *
     * @return string
     */
    public function actionIngresoVehiculo($addId=null)
    {
        $model = new Movements();
        $model->check_in = date('Y-m-d H:i:s');
        $model->check_in_user_id = Yii::$app->user->identity->id;
        Yii::$app->session->removeFlash('existPlanE');
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $query = Movements::find();
                $query->andFilterWhere([
                    'plate' => $model->plate,
                    'type_id' => $model->type_id,
                ]);
                $query->andWhere('check_out IS NULL');
                // $query->andFilterWhere(['not', ['check_out_user_id' => null]]);
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                if (count($dataProvider->models) > 0) {
                    Yii::$app->session->setFlash('existVehicle');
                    // $model = new Movements();

                    // echo json_encode($dataProvider->models[0]->id);
                } else {
                    if ($model->check_out == null  && $model->save()) {
                        // Yii::$app->session->setFlash('VehicleEntrySuccessful!');
                        // return $this->refresh();
                        return $this->redirect(['ingreso-vehiculo', 'addId' => $model->id]);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        // $searchModel = new MovementsSearch();
        // $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('ingreso-vehiculo', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'model' => $model,
            'addId' => $addId,
        ]);
    }
}