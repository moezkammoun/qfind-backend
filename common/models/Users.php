<?php

namespace common\models;

use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $mobile
 * @property integer $status
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $created_on
 * @property integer $role
 * @property string $last_login
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface {

    /**
     * @inheritdoc
     */
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['first_name', 'last_name', 'email', 'mobile', 'status', 'role', 'password_hash'], 'required', 'on' => 'create'],
            [['first_name', 'last_name', 'email', 'mobile', 'status', 'role'], 'required', 'on' => 'update'],
            [['mobile', 'status', 'role'], 'integer'],
            [['created_on', 'last_login'], 'safe'],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 200],
            [['auth_key', 'password_reset_token'], 'string', 'max' => 254],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password_hash' => 'Password',
            'mobile' => 'Mobile',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'created_on' => 'Created On',
            'role' => 'Role',
            'last_login' => 'Last Login',
        ];
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

}
