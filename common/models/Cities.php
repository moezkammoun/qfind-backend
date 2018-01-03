<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $name
 * @property integer $state_id
 *
 * @property Sellers[] $sellers
 */
class Cities extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//                    [['name', 'state_id', 'canonical_name'], 'required'],
            [['name', 'name_arabic'], 'required'],
            [['state_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'name_arabic' => 'Name In Arabic',
            'state_id' => 'State ID',
            'canonical_name' => 'Canonical Name'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSellers() {
        return $this->hasMany(Sellers::className(), ['city' => 'id']);
    }

    public function getState() {
        return $this->hasOne(States::className(), ['id' => 'state_id']);
    }

}
