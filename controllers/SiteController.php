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
        $user_ip = Yii::$app->request->userIP;//Получаем ip пользователя
        $entryLikes = Likes::find()->all();//Выборка данных таблицы likes
        $sample = Records::find()->orderBy(['date' => SORT_DESC]);//Формирование пагинации начало
        $pages = new Pagination(['totalCount' => $sample->count(), 'pageSize' => 2, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $records = $sample->offset($pages->offset)->limit($pages->limit)->all();//конец
        if ($entry->load(Yii::$app->request->post())) {//Если кнопка добавить на форме нажата
            if($_POST['Records']['link'] == NULL)//Если ссылка осталась пуста, подставляется заглушка
            {
                $entry->link = 'https://www.google.ru/';
            }
            if($entry->validate() && $entry->save()){//При успешном добавлении записи
                $likes->post_id = $entry->id;//В таблицу likes добавляется запись с текущего ip для добавленной записи
                $likes->user_ip = $user_ip;//
                $likes->save();
                $entry->gallery = UploadedFile::getInstances($entry, 'gallery');//Обработка изображений
                if( $entry->gallery ){
                    $entry->uploadGallery();
                }
                return $this->redirect(['/']);
            }
        }

        return $this->render('index', compact('pages', 'records', 'entry', 'user_ip', 'entryLikes'));
    }

    public function actionLikes($id)
    {
        if (Yii::$app->request->isAjax) {
            $likes = new Likes();
            $user_ip = Yii::$app->request->userIP;//Получение ip юзера
            $entryLike = Likes::find()->where(['post_id' => $id, 'user_ip' => $user_ip])->one();//Выборка записи заданного юзера по заданному ip
            $entryAllLikes = Records::findOne($id);//Запись(сообщение) в таблице records
            if ($entryLike != NULL) //Проверка на наличие
            {
                if ($entryLike->status == 0) {//Проверяется статус лайка. Если - нет, то лайкается
                    $entryLike->status = 1;
                    $entryLike->save();
                    $entryAllLikes->likes += 1;
                    $entryAllLikes->save();
                } elseif ($entryLike->status == 1) { //Если - да, то дизлайкается
                    $entryLike->status = 0;
                    $entryLike->save();
                    $entryAllLikes->likes -= 1;
                    $entryAllLikes->save();
                }

            } else {//Если user не найден, то регистрируется новый и сохраняется со статусом-лайкнуто
                $likes->post_id = $id;
                $likes->user_ip = $user_ip;
                $likes->status = 1;
                $likes->save();
                $entryAllLikes->likes += 1;
                $entryAllLikes->save();
            }
        }


    }

}
