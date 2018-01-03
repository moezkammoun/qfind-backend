<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qfind_service".
 *
 * @property integer $id
 * @property string $title
 * @property string $date_from
 * @property string $date_to
 * @property integer $status
 * @property integer $service
 * @property string $dou
 * @property string $doc
 * @property integer $cb
 * @property integer $ub
 */
class QfindService extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'qfind_service';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['date_from', 'date_to', 'status', 'service', 'cb', 'ub'], 'required'],
            [['date_from', 'date_to', 'dou', 'doc'], 'safe'],
//            [['date_to'], 'compare', 'compareAttribute' => 'date_from', 'operator' => '>=', 'skipOnEmpty' => true],
//            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
//            [['date_to'], 'compare', 'compareAttribute' => 'date_from', 'operator' => '>'],
            [['date_to'], 'validateDates'],
            [['status', 'service', 'cb', 'ub'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'status' => 'Status',
            'service' => 'Service',
            'dou' => 'Dou',
            'doc' => 'Doc',
            'cb' => 'Cb',
            'ub' => 'Ub',
        ];
    }

    public function validateDates() {

//        $get_from = QfindService::find()->where($this->date_from . '>= date_from AND ' . $this->date_from . '<= date_to')->one();
        $get_from = QfindService::find()->where('date_from <= "' . $this->date_from . '" AND  date_to >= "' . $this->date_from . '"')->one();
        $get_to = QfindService::find()->where('date_from <= "' . $this->date_to . '" AND  date_to >= "' . $this->date_to . '"')->one();
//        $get_to = QfindService::find()->where($this->date_to . '>= date_from AND ' . $this->date_to . '<= date_to')->one();
//        var_dump($get_from);
//        exit;
        if ($this->date_from >= $this->date_to) {
            $this->addError('date_to', 'Date to must be grater than Date from');
        } else {
            if ($get_from != NULL) {
                $this->addError('date_from', 'Invalid Date. The date already choosen');
            }
            if ($get_to != NULL) {
                $this->addError('date_to', 'Invalid Date. The date already choosen');
            }
        }
    }

}
