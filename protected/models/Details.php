<?php

/**
 * This is the model class for table "{{details}}".
 *
 * The followings are the available columns in table '{{details}}':
 * @property integer $id
 * @property integer $profile_id
 * @property string $length
 * @property integer $quantity
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Profile $profile
 */
class Details extends CActiveRecord
{
	//const STATUS_DRAFT=;
	const STATUS_ACTIVE=1;
	const STATUS_ARCHIVED=2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{details}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profile_id, length, quantity', 'required'),
			array('profile_id, quantity, status', 'numerical', 'integerOnly'=>true),
			array('length', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, profile_id, length, quantity, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'profile' => array(self::BELONGS_TO, 'Profile', 'profile_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'profile_id' => 'Profile',
			'length' => 'Длина',
			'quantity' => 'Количество',
			'status' => 'Состояние',
		);
	}

	/**
	 * @return string the URL that shows the detail of the profile
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('/', array(
			'list'=>$this->profile_id,
		));
	}

	public function getProfileLink()
	{
			return CHtml::link(CHtml::encode($this->profile->name), array('details/index', 'name' => $this->profile->name), $linkOptions=array('class'=>'profile'));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('profile_id',$this->profile_id);
		$criteria->compare('length',$this->length,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
				'pageSize'=>(int)Yii::app()->session['detailsPageCount'] ? Yii::app()->session['detailsPageCount'] : 10,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Details the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
