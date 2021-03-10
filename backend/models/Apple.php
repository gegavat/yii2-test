<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property int $color
 * @property int $created_at
 * @property int|null $fallen_at
 * @property string $status
 * @property int|null $residue
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['created_at', 'fallen_at', 'residue'], 'integer'],
            [['color', 'status'], 'string'],
            [['fallen_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'on_tree'],
            [['residue'], 'default', 'value' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'created_at' => 'Created At',
            'fallen_at' => 'Fallen At',
            'status' => 'Status',
            'residue' => 'Residue',
        ];
    }
}
