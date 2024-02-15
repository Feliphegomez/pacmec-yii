<?php

namespace app\modules\sparking\models;

use Yii;

/**
 * This is the model class for table "type_parking".
 *
 * @property int $id
 * @property string $name
 * @property string $prices
 *
 * @property Movements[] $movements
 */
class TypeParking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_parking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'prices'], 'required'],
            [['prices'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'prices' => 'Cobros',
        ];
    }

    /**
     * Gets query for [[Movements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovements()
    {
        return $this->hasMany(Movements::class, ['type_id' => 'id']);
    }
}
