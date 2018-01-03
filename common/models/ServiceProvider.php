<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_provider".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $website
 * @property string $email
 * @property string $phone
 * @property integer $city
 * @property string $locality
 * @property string $location
 * @property string $working_time_from
 * @property string $working_time_to
 * @property string $facebook
 * @property string $linkedin
 * @property string $instagram
 * @property string $twitter
 * @property string $snapchat
 * @property string $googleplus
 * @property integer $cb
 * @property integer $category_id
 * @property integer $ub
 * @property string $doc
 * @property string $dou
 * @property integer $status
 */
class ServiceProvider extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'service_provider';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'name_arabic', 'category_id', 'website', 'email', 'phone', 'city', 'locality_arabic', 'locality', 'latitude', 'longitude', 'working_time_from', 'working_time_to', 'facebook', 'linkedin', 'instagram', 'twitter', 'snapchat', 'googleplus', 'cb', 'ub', 'status'], 'required'],
            [['image'], 'required', 'on' => 'create'],
            [['city', 'cb', 'ub', 'status', 'category_id'], 'integer'],
            [['working_time_from', 'working_time_to', 'doc', 'dou', 'tags', 'latitude'], 'safe'],
            [['name', 'website', 'name_arabic', 'email'], 'string', 'max' => 250],
            ['image', 'image', 'skipOnEmpty' => true, 'minWidth' => 100, 'maxWidth' => 1024, 'minHeight' => 100, 'maxHeight' => 1024, 'extensions' => 'jpg,png,jeg', 'maxSize' => 1024 * 1024 * 1, 'maxFiles' => 5],
            [['image', 'locality'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 13],
            ['email', 'email'],
            [['facebook', 'linkedin', 'instagram', 'twitter', 'snapchat', 'googleplus'], 'string', 'max' => 255],
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
            'image' => 'Image',
            'website' => 'Website',
            'category_id' => 'Category',
            'email' => 'Email',
            'phone' => 'Phone',
            'city' => 'Area',
            'locality' => 'Address',
            'locality_arabic' => 'Address In Arabic',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'working_time_from' => 'Working Time From',
            'working_time_to' => 'Working Time To',
            'facebook' => 'Facebook',
            'linkedin' => 'Linkedin',
            'instagram' => 'Instagram',
            'twitter' => 'Twitter',
            'snapchat' => 'Snapchat',
            'googleplus' => 'Googleplus',
            'cb' => 'Cb',
            'ub' => 'Ub',
            'doc' => 'Doc',
            'dou' => 'Dou',
            'status' => 'Status',
        ];
    }

}
