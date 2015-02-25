<?php
	public function actionCURL()
	{
        $message = '';
        if (!empty($_POST)) { //разобраться
            try {
                $objPHPExcel = $objReader->load($spec); //изменить
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0); //изменить
                $highestRow = $objWorksheet->getHighestRow(); //изменить

                for ($row=1; $row<$highestRow; $row++){
                    $details = new Details();
                    $details -> length = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue(); //изменить
                    $details -> quantity = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue(); //изменить
                    if ($details -> save(false)){
                        
                    }
                }
            }
            catch (Exception $e) {
                $message = 'Была проблема обработки таблицы. технические детали: '.$e->getMessage();
            }
            if (! empty($message)) {
                Yii::app()->user->setFlash('error',$message);
            }
        }
        $this->render('index');
	}
?>