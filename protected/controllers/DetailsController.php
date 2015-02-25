<?php

class DetailsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','list','lis','test','stop'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Details;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Details']))
		{
			$model->attributes=$_POST['Details'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionTest ()
    {
        $criteria=new CDbCriteria();
        $criteria->with = 'profile';
		if(isset($_GET['profile_id']))
			$criteria->compare('profile_id',$_GET['profile_id']);
        $details = Details::model()->findAll($criteria);
        echo "<pre>";
        print_r ($details);
        echo "<pre>";
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Details']))
		{
			$model->attributes=$_POST['Details'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionList() {
        //$this->curl();

		$criteria=new CDbCriteria(array(
            'condition'=>'t.status=0',
		));
        //$criteria->limit = 5;

        		if(isset($_GET['profile_id']))
        			$criteria->compare('profile_id',$_GET['profile_id']);

        $enabledList = Details::model()->with('profile')->findAll($criteria);

        /*echo "<pre>";
        print_r ($enabledList);
        echo "</pre>";*/

            $queryString='';
            foreach ($enabledList as $item) {

                $queryString = "Test%5Blength%5D=".$item->length."&Test%5Bquantity%5D=".$item->quantity."&yt0=Create";
        echo "<pre>";
        print_r ($queryString);
        echo "</pre>";
        
            }
$a=$_GET['a'];
echo($a);
    foreach ($enabledList as $item) {
        if ($a=="1"){
            $queryString = "Test%5Blength%5D=".$item->length."&Test%5Bquantity%5D=".$item->quantity."&yt0=Create";
            echo "<pre>";
            print_r ($queryString);
            echo "</pre>";
            $ch = curl_init();
            sleep(5);
            $url = "http://cms.ua/index.php/test/create";
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
            curl_setopt($ch,CURLOPT_POSTFIELDS,$queryString);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
            curl_setopt($ch,CURLOPT_TIMEOUT, 20);
            $item->status = '0';
            $item->save();
            curl_exec($ch);
            curl_close ($ch);
        }
        else {
            break;
        }
    }
}

    public function curl(){

		$criteria=new CDbCriteria(array(
            'condition'=>'t.status=0',
		));
        //$criteria->limit = 5;

        		if(isset($_GET['profile_id']))
        			$criteria->compare('profile_id',$_GET['profile_id']);

        $enabledList = Details::model()->with('profile')->findAll($criteria);

        echo "<pre>";
        print_r ($enabledList);
        echo "</pre>";

            $queryString='';
            /*foreach ($enabledList as $item) {

                $queryString = "Test%5Blength%5D=".$item->length."&Test%5Bquantity%5D=".$item->quantity."&yt0=Create";
        echo "<pre>";
        print_r ($queryString);
        echo "</pre>";
            }*/

foreach ($enabledList as $item) {
    //if ($sleep == 1) {
//$f = file_get_content('control.txt');
        $queryString = "Test%5Blength%5D=".$item->length."&Test%5Bquantity%5D=".$item->quantity."&yt0=Create";
         echo "<pre>";
        print_r ($queryString);
        echo "</pre>";
    if($queryString == 'sleep')
    {
        sleep(1000);
    }
        $ch = curl_init();
        sleep(5);
        $url = "http://cms.ua/index.php/test/create";
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
        curl_setopt($ch,CURLOPT_POSTFIELDS,$queryString);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);
        $item->status = '0';
        $item->save();
        curl_exec($ch);
        curl_close ($ch);
//sleep(3);
//}
    }

/*
        //$enabledList = Details::model()->findAll();
        if ($enabledList) {
            $queryString='';
            foreach ($enabledList as $item) {
                sleep(5);
                $queryString = "Test%5Blength%5D=".$item->length."&Test%5Bquantity%5D=".$item->quantity."&yt0=Create";

        echo "<pre>";
        echo $queryString;
        echo "</pre>";
        
                $ch = curl_init();
                $url = "http://cms.ua/index.php/test/create";
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
                curl_setopt($ch,CURLOPT_POSTFIELDS,$queryString);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
                curl_setopt($ch,CURLOPT_TIMEOUT, 20);
                curl_exec($ch);
                curl_close ($ch);
                //unset($enabledList);
                //return $queryString;
                    Yii::app()->user->setFlash('sucess','База данных успешно импортирована');
            }
        }*/
    }


    public function actionStop(){
        curl_close ($ch);
    }


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionLis($id)
	{
		$criteria=new CDbCriteria(array(
			'with'=>'details',
		));

		if(isset($_GET['id']))
			$criteria->compare('id',$_GET['id']);

$enabledList = Details::model()->findAll($criteria);


echo "<pre>";
echo $_GET['profile_id'];
echo "</pre>";
/*
        //$enabledList = Details::model()->findAll();
        if ($enabledList) {
            $queryString='';
            foreach ($enabledList as $item) {
                sleep(5);
                $queryString = "Test%5Blength%5D=".$item->length."&Test%5Bquantity%5D=".$item->quantity."&yt0=Create";
                $ch = curl_init();
                $url = "http://cms.ua/index.php/test/create";
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
                curl_setopt($ch,CURLOPT_POSTFIELDS,$queryString);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
                curl_setopt($ch,CURLOPT_TIMEOUT, 20);
               curl_exec($ch);
                curl_close ($ch);
                //unset($enabledList);
                //return $queryString;
                    Yii::app()->user->setFlash('sucess','База данных успешно импортирована');
            }
        }*/
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria(array(
			'with'=>'profile',
		));

		if(isset($_GET['profile_id']))
			$criteria->compare('profile_id',$_GET['profile_id']);
        
		$countProfileDetails = Details::model()->count($criteria); // указывает сколько у автора материалов                 

		$dataProvider=new CActiveDataProvider('Details', array(
			'criteria'=>$criteria,
		));


		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'countProfileDetails'=>$countProfileDetails,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Details('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Details']))
			$model->attributes=$_GET['Details'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Details the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Details::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Details $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='details-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
