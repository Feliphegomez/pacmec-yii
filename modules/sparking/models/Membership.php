<?php

namespace app\modules\sparking\models;

use Yii;
use app\modules\sparking\models\TypeParking;

/**
 * This is the model class for table "membership".
 *
 * @property int $id
 * @property string $name Nombre
 * @property int $type_id Tipo de vehiculo
 * @property float $price Precio
 * @property string $duration Duracion de la membresia
 *
 * @property Plans[] $plans
 * @property TypeParking $type
 */
class Membership extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membership';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type_id', 'price', 'duration'], 'required'],
            [['type_id'], 'integer'],
            [['price'], 'number'],
            [['duration'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Nombre',
            'type_id' => 'Tipo de vehiculo',
            'price' => 'Precio',
            'duration' => 'Duracion de la membresia',
        ];
    }

    /**
     * Gets query for [[Plans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plans::class, ['membership_id' => 'id']);
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
