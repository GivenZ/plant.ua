<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property integer $id
 * @property string $name
 * @property integer $project_id
 * @property integer $quantity
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Details[] $details
 * @property Project $project
 */
class Profile extends CActiveRecord
{

	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{profile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, project_id, quantity', 'required'),
			array('project_id, quantity, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, project_id, quantity, status', 'safe', 'on'=>'search'),
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
			'details' => array(self::HAS_MANY, 'Details', 'profile_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Наименование',
			'project_id' => 'Project',
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
			'profiles'=>$this->id,
		));
	}

	public function getProjectLink()
	{
			return CHtml::link(CHtml::encode($this->project->projectname), array('profile/index', 'projectname' => $this->project->projectname), $linkOptions=array('class'=>'project'));
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
				'pageSize'=>(int)Yii::app()->session['profilePageCount'] ? Yii::app()->session['profilePageCount'] : 10,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Profile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
