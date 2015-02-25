<?php
abstract class YiicoActiveRecord extends CActiveRecord
{
	 /**
	 * Prepares create_time, create_user_id, update_time and update_user_id attributes before performing validation.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->project_id=Yii::app()->project->id;
				$this->profile_id=Yii::app()->profile->id;
			}
			else
			return true;
		}
		else
			return false;	
	}
	
}
