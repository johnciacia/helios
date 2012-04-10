<?php

/**
 * This is the model class for table "rubric_meta".
 *
 * The followings are the available columns in table 'rubric_meta':
 *
 * @property string $id
 * @property integer $rubric_id
 * @property string $item_label
 * @property integer $item_type
 * @property integer $position
 */
class RubricMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string  $className active record class name.
	 * @return RubricMeta the static model class
	 */
	public static function model( $className = __CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 *
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'rubric_meta';
	}

	/**
	 *
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'rubric_id, item_type, position', 'numerical', 'integerOnly' => true ),
			array( 'item_label', 'safe' ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'id, rubric_id, item_label, item_type, position', 'safe', 'on' => 'search' ),
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
		return array();
	}

	/**
	 *
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'rubric_id' => 'Rubric',
			'item_label' => 'Item Label',
			'item_type' => 'Item Type',
			'position' => 'Position',
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

		$criteria = new CDbCriteria;

		$criteria->compare( 'id', $this->id, true );
		$criteria->compare( 'rubric_id', $this->rubric_id );
		$criteria->compare( 'item_label', $this->item_label, true );
		$criteria->compare( 'item_type', $this->item_type );
		$criteria->compare( 'position', $this->position );

		//@todo: this should use a join not an IN condition
		$rubrics = Rubric::model()->findAll(array('condition' => 'user_id=:user_id', 'params' => array(':user_id'=> Yii::app()->user->id) ) );
		$r = array();
		foreach( $rubrics as $rubric ) {
			$r[] = $rubric->id;
		}
		$criteria->addInCondition( 'rubric_id', $r );

		return new CActiveDataProvider( $this, array(
				'criteria'=>$criteria,
			) );
	}

	public function beforeSave() {
		//@todo: make sure rubric_id a rubric the authenticated user created
		//@todo: make sure item_type is a valid item
		parent::beforeSave();
	}

	public function getItems() {
		//@todo: return a list of valid form items
		return array();
	}
}
