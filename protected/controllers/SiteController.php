<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
            /*if(Yii::app()->user->isGuest)
        $this->actionLogin();
    else
        $this->redirect('/project');*/
	}


	/**
	 * This is the default 'import' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionLoad()
	{
        $model = new Load;

        if(isset($_POST['Load']))
        {

            $model->attributes=$_POST['Load'];

            if($model->validate())
            {

            $model=CUploadedFile::getInstance($model,'file');

            if($model->getType()=='application/vnd.ms-excel')
            {
                $excelFile = $model->getTempName();
                $phpexcel = new PHPExcel;
                $excelReader = PHPExcel_IOFactory::createReader('Excel5');
  
                $phpexcel = $excelReader -> load($excelFile) -> getSheet(0);
                $total_line = $phpexcel -> getHighestRow();//total line
                $total_column = $phpexcel -> getHighestColumn();//total column
                for ($row = 2; $row <= $total_line; $row++){//Число строк начало первой линии
                    if(trim($phpexcel->getCell("A".$row)->getValue())!="")
                    {
                        $data = array();
                        for ($column = 'A'; $column <= $total_column; $column++) {//Колонка число столбцов начинают
                            $data[] = trim($phpexcel -> getCell($column.$row) -> getValue());
                        }

                        $mpProject = new Project;
                        $mpProject -> projectname = trim($data['0']);
                        $mpProject -> save();

                        $mpProfile = new Profile;
                        $mpProfile -> name = trim($data['1']);
                        $mpProfile -> project_id = $mpProject->id;
                        $mpProfile -> quantity = trim($data['2']);
                        $mpProfile -> status = trim($data['3']);
                        $mpProfile -> save();

                        $mpDetails = new Details;
                        $mpDetails -> profile_id = $mpProfile->id;
                        $mpDetails -> length = trim($data['4']);
                        $mpDetails -> quantity = trim($data['5']);
                        $mpDetails -> status = trim($data['6']);
                        $mpDetails -> save();

                    }
                }
            }
            }
        }

		$this->render('load',array(
			'model'=>$model,
		));

	}




	public function actionExcel(){
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("SharkZ")
             ->setLastModifiedBy("SharkZ")
             ->setTitle("YiiExcel Test Document")
             ->setSubject("YiiExcel Test Document")
             ->setDescription("Test document for YiiExcel, generated using PHP classes.")
             ->setKeywords("office PHPExcel php YiiExcel UPNFM")
             ->setCategory("Test result file");        
        
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
        
        // Miscellaneous glyphs, UTF-8
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'Проверка');
        
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('YiiExcel');
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        
        // Save a xls file
        $filename = 'YiiExcel';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        unset($this->objWriter);
        unset($this->objWorksheet);
        unset($this->objReader);
        unset($this->objPHPExcel);
        exit();
    }//fin del método actionExcel


public function actionTest()
{
  // register PHPExcel autoloader

    Yii::import('application.vendors.phpexcel.PHPExcel',true);

$model->import_file = CUploadedFile::getInstance($model,'import');
// Создаем объект класса PHPExcel
$import_file = PHPExcel_IOFactory::load($model->import_file->tempName);

    // load excel template
    $wbook=PHPExcel_IOFactory::load('report_1.xlsx');
    $sheet=$wbook->setActiveSheetIndex(); // get sheet

    // get named range 'range1' and set its value
    $sheet->getCell('A1')->setValue(7777);

    // or set value with type specified
    $sheet->getCell('A1')->setValueExplicit(7777,PHPExcel_Cell_DataType::TYPE_NUMERIC);

    // create writer and save to file
    $writer=PHPExcel_IOFactory::createWriter($wbook,'Excel2007');
    $writer->save('report_1_data.xlsx');
		$this->render('contact',array('model'=>$model));
}




	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}