<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Records;
use yii\data\Pagination;
use yii\web\HttpException;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $entry = new Records();
        $sample = Records::find();;
        $pages = new Pagination(['totalCount' => $sample->count(), 'pageSize' => 2, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $records = $sample->offset($pages->offset)->limit($pages->limit)->all();
        if ($entry->load(Yii::$app->request->post())) {
            $entry->author =  $_POST['Records']['author'];
            $entry->content =  $_POST['Records']['content'];
            if($_POST['Records']['link'] == NULL)
            {
                $entry->link = 'https://www.google.ru/';
            } else {
                $entry->link =  $_POST['Records']['link'];
            }
            if($entry->validate() && $entry->save()){
                $entry->gallery = UploadedFile::getInstances($entry, 'gallery');
                if( $entry->gallery ){
                    $entry->uploadGallery();
                }
                return $this->redirect(['/']);
            }
        }

        return $this->render('index', ['pages' => $pages, 'records' => $records, 'entry' => $entry]);
    }

}
