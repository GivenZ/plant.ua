<?php

class ImportController extends Controller
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'import'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
        $message = '';
        if (!empty($_POST)) {
            $file = CUploadedFile::getInstanceByName('import');
            $spec = Yii::app()->basePath.'/data/imports/'.$file->name;
            $file->saveAs($spec);

            spl_autoload_unregister(array('YiiBase','autoload'));
            $phpExcelPath = Yii::getPathOfAlias('application.vendors.phpexcel');
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            spl_autoload_register(array('YiiBase', 'autoload'));

            try {
                $inputFileType = PHPExcel_IOFactory::identify($spec); 
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);

                if ($inputFileType != 'xls') {
                    $objReader->setReadDataOnly(true);
                }

                $objPHPExcel = $objReader->load($spec); 
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $objWorksheet->getHighestRow();
                
                
                $prevProfile=null; $prevProj=null;
                for ($row = 2; $row < $highestRow; $row++) {
                    $projName=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                    if( $projName && (!$prevProj || $projName!=$prevProj->projectname)){
                        $model = new Project('create');
                        $model->projectname = $projName;
                        if ($model->save(false)) {
                             $prevProj=$model;
                        }
                    }
                    $profileName=$objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                    if($profileName && (!$prevProfile || $profileName!==$prevProfile->name)){
                        $profile = new Profile();
                         $profile->project_id = $prevProj->id;
                          $profile->name =$profileName;
                          $profile->quantity = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $profile->status = $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
                        if ($profile->save(false)) {
                             $prevProfile=$profile;
                         }
                    }
                    
                    $details = new Details();
                    $details->profile_id = $prevProfile->id;
                    $details->length = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $details->quantity = $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $details->status = 0;
                    if ($details->save(false)) {

                    }

                    Yii::app()->user->setFlash('sucess','База данных успешно импортирована');
                }
            }
            catch (Exception $e) {
                $message = 'Был проблема обработки файла. технические детали: '.$e->getMessage();
            }
            if (! empty($message)) {
                Yii::app()->user->setFlash('error',$message);
            }
        }
        $this->render('index');
	}

    public function actionImport()
    {
        $message = '';
        if (!empty($_POST)) {
            $file = CUploadedFile::getInstanceByName('import');
            $spec = Yii::app()->basePath.'/data/imports/'.$file->name;
            $file->saveAs($spec);

            spl_autoload_unregister(array('YiiBase','autoload'));
            $phpExcelPath = Yii::getPathOfAlias('application.vendors.phpexcel');
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            spl_autoload_register(array('YiiBase', 'autoload'));

            try {
                $inputFileType = PHPExcel_IOFactory::identify($spec); 
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);

                if ($inputFileType != 'xls') {
                    $objReader->setReadDataOnly(true);
                }

                $objPHPExcel = $objReader->load($spec); 
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $objWorksheet->getHighestRow();
                
                
                $prevProfile=null; $prevProj=null;
                for ($row = 2; $row < $highestRow; $row++) {
                    $projName=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                    if( $projName && (!$prevProj || $projName!=$prevProj->projectname)){
                        $model = new Project('create');
                        $model->projectname = $projName;
                        if ($model->save(false)) {
                             $prevProj=$model;
                        }
                    }
                    $profileName=$objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                    if($profileName && (!$prefProfile || $profileName!==$prefProfile->name)){
                        $profile = new Profile();
                         $profile->project_id = $prevProj->id;
                          $profile->name =$profileName;
                          $profile->quantity = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $profile->status = $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
                        if ($profile->save(false)) {
                             $prevProfile=$profile;
                         }
                    }
                    
                    $details = new Details();
                    $details->profile_id = $prevProfile->id;
                    $details->length = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $details->quantity = $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $details->status = $objWorksheet->getCellByColumnAndRow(6, $row)->getValue();
                    if ($details->save(false)) {

                    }

                    Yii::app()->user->setFlash('sucess','База данных успешно импортирована');
                }
            }
            catch (Exception $e) {
                $message = 'Был проблема обработки файла. технические детали: '.$e->getMessage();
            }
            if (! empty($message)) {
                Yii::app()->user->setFlash('error',$message);
            }
        }
        $this->render('import');
    }


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}