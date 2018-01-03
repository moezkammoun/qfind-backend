<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property integer $date_from_buffer
 * @property integer $service_provider_image
 * @property integer $status
 * @property string $doc
 * @property string $dou
 * @property integer $ub
 * @property integer $cb
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_from_buffer', 'service_provider_image', 'status', 'doc', 'ub', 'cb'], 'required'],
            [['date_from_buffer', 'service_provider_image', 'status', 'ub', 'cb'], 'integer'],
            [['doc', 'dou'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_from_buffer' => 'Date From Buffer',
            'service_provider_image' => 'Service Provider Image',
            'status' => 'Status',
            'doc' => 'Doc',
            'dou' => 'Dou',
            'ub' => 'Ub',
            'cb' => 'Cb',
        ];
    }
}
