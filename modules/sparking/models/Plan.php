<?php

namespace app\modules\sparking\models;

use Yii;

/**
 * This is the model class for table "plans".
 *
 * @property int $id
 * @property string $plate Placa
 * @property int $type_id Tipo de vehiculo
 * @property int $membership_id Membresia
 * @property string $date_start Fecha inicio
 * @property string $date_end Fecha fin
 * @property float $payment_value
 *
 * @property Membership $membership
 * @property TypeParking $type
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plate', 'type_id', 'membership_id', 'date_start', 'date_end', 'payment_value'], 'required'],
            [['type_id', 'membership_id'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['payment_value'], 'number'],
            [['plate'], 'string', 'max' => 255],
            [['membership_id'], 'exist', 'skipOnError' => true, 'targetClass' => Membership::class, 'targetAttribute' => ['membership_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeParking::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plate' => 'Placa',
            'type_id' => 'Tipo de vehiculo',
            'membership_id' => 'Membresia',
            'date_start' => 'Fecha inicio',
            'date_end' => 'Fecha fin',
            'payment_value' => 'Valor cobro',
        ];
    }

    /**
     * Gets query for [[Membership]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembership()
    {
        return $this->hasOne(Membership::class, ['id' => 'membership_id']);
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
