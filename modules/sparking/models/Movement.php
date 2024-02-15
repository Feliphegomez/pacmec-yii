<?php

namespace app\modules\sparking\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "movements".
 *
 * @property int $id
 * @property string $plate Placa del vehiculo
 * @property int $type_id Tipo de vehiculo
 * @property string $check_in Fecha de llegada
 * @property int $check_in_user_id Usuario llegada
 * @property string|null $check_out Fecha de salida
 * @property int|null $check_out_user_id Usuario salida
 * @property string|null $time_elapsed Tiempo transcurrido
 * @property float|null $payment_value Valor cobro
 *
 * @property User $checkInUser
 * @property User $checkOutUser
 * @property TypeParking $type
 */
class Movement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plate', 'type_id', 'check_in', 'check_in_user_id'], 'required'],
            [['type_id', 'check_in_user_id', 'check_out_user_id'], 'integer'],
            [['check_in', 'check_out', 'time_elapsed'], 'safe'],
            [['payment_value'], 'number'],
            [['plate'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeParking::class, 'targetAttribute' => ['type_id' => 'id']],
            [['check_in_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['check_in_user_id' => 'id']],
            [['check_out_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['check_out_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plate' => 'Placa del vehiculo',
            'type_id' => 'Tipo de vehiculo',
            'check_in' => 'Fecha de llegada',
            'check_in_user_id' => 'Usuario llegada',
            'check_out' => 'Fecha de salida',
            'check_out_user_id' => 'Usuario salida',
            'time_elapsed' => 'Tiempo transcurrido',
            'payment_value' => 'Valor cobro',
        ];
    }

    /**
     * Gets query for [[CheckInUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckInUser()
    {
        return $this->hasOne(User::class, ['id' => 'check_in_user_id']);
    }

    /**
     * Gets query for [[CheckOutUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckOutUser()
    {
        return $this->hasOne(User::class, ['id' => 'check_out_user_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeParking::class, ['id' => 'type_id']);
    }
}