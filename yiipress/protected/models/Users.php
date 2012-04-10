<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $display_name
 * @property string $activation_key
 * @property integer $status
 */
class Users extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string  $className active record class name.
	 * @return Users the static model class
	 */
	public static function model( $className=__CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 *
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'users';
	}

	/**
	 *
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'status', 'numerical', 'integerOnly'=>true ),
			array( 'username, email, first_name, last_name, display_name', 'length', 'max'=>255 ),
			array( 'password, activation_key', 'length', 'max'=>40 ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'id, username, password, email, first_name, last_name, display_name, activation_key, status', 'safe', 'on'=>'search' ),
		);
	}

	/**
	 *
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 *
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'display_name' => 'Display Name',
			'activation_key' => 'Activation Key',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare( 'id', $this->id, true );
		$criteria->compare( 'username', $this->username, true );
		$criteria->compare( 'password', $this->password, true );
		$criteria->compare( 'email', $this->email, true );
		$criteria->compare( 'first_name', $this->first_name, true );
		$criteria->compare( 'last_name', $this->last_name, true );
		$criteria->compare( 'display_name', $this->display_name, true );
		$criteria->compare( 'activation_key', $this->activation_key, true );
		$criteria->compare( 'status', $this->status );

		return new CActiveDataProvider( $this, array(
				'criteria'=>$criteria,
			) );
	}

	public function validatePassword( $password ) {
		return sha1( $password ) === $this->password;
	}
	
}
