<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use yii\web\Controller;
use \yii\helpers\FileHelper;
use yii\data\ArrayDataProvider;
/**
 * Description of Printing
 *
 * @author p.lukengu
 */
class PrintingController extends Controller
{

    //put your code here
    public function actionLargeformat()
    {
        $path = \yii::$app->request->baseUrl . "images/printing/large_format/";
        $files = FileHelper::findFiles($path, ['recursive' => FALSE]);
        //print_r($files); exit;
        
        return $this->render('large_format', ['files' => $files]);
    }

}


