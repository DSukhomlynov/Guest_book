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
use app\models\Likes;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $likes = new Likes();
        $entry = new Records();
        $user = Yii::$app->request->userIP;
        $entryLikes = Likes::find()->all();
        $sample = Records::find();;
        $pages = new Pagination(['totalCount' => $sample->count(), 'pageSize' => 2, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $records = $sample->offset($pages->offset)->limit($pages->limit)->all();
        if ($entry->load(Yii::$app->request->post())) {
            if($_POST['Records']['link'] == NULL)
            {
                $entry->link = 'https://www.google.ru/';
            }
            if($entry->validate() && $entry->save()){
                $likes->post_id = $entry->id;
                $likes->user_ip = $user;
                $likes->save();
                $entry->gallery = UploadedFile::getInstances($entry, 'gallery');
                if( $entry->gallery ){
                    $entry->uploadGallery();
                }
                return $this->redirect(['/']);
            }
        }

        return $this->render('index', compact('pages', 'records', 'entry', 'user', 'entryLikes'));
    }

    public function actionLikes($id){
        $likes = new Likes();
        $entry = new Records();
        $user = Yii::$app->request->userIP;
        $entryLikes = Likes::find()->where(['post_id' => $id])->all();
        $entryAllLikes = Records::findOne($id);

        foreach ($entryLikes as $like)
        {
            if(($like->user_ip) == $user){
                if($like->status == 0){
                    $like->status = 1;
                    $like->save();
                    $entryAllLikes->likes += 1;
                    $entryAllLikes->save();
                    return $this->redirect(['/']);
                } elseif($like->status == 1){
                    $like->status = 0;
                    $like->save();
                    $entryAllLikes->likes -= 1;
                    $entryAllLikes->save();
                    return $this->redirect(['/']);
                }
            }
        }
        $likes->post_id = $id;
        $likes->user_ip = $user;
        $likes->status = 1;
        $likes->save();

        return $this->redirect(['/']);
    }

}
