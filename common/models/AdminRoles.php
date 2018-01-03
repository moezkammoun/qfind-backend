<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_roles".
 *
 * @property integer $id
 * @property string $role_name
 * @property integer $cb
 * @property integer $ub
 * @property string $doc
 * @property string $dou
 * @property integer $category_access
 * @property integer $advt_access
 * @property integer $cms_access
 */
class AdminRoles extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'admin_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['role_name', 'category_access', 'advt_access', 'cms_access'], 'required'],
            [['cb', 'ub', 'category_access', 'advt_access', 'cms_access'], 'integer'],
            [['doc', 'dou'], 'safe'],
            [['role_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'role_name' => 'Role Name',
            'cb' => 'Created By',
            'ub' => 'Last Updated By',
            'doc' => 'Date Of created',
            'dou' => 'date of updated',
            'category_access' => 'User,Category Access',
            'advt_access' => 'Advertisement  Access',
            'cms_access' => 'Content Access',
        ];
    }

}
