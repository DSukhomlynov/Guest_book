<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "records".
 *
 * @property integer $id
 * @property string $author
 * @property string $content
 * @property string $date
 * @property string $link
 * @property integer $likes
 */
class Records extends ActiveRecord
{

    public $image;
    public $gallery;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author', 'content', 'link'], 'required'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['likes'], 'integer'],
            [['author', 'link'], 'string', 'max' => 255],
            ['link', 'url', 'defaultScheme' => 'http'],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Автор',
            'content' => 'Сообщение',
            'date' => 'Date',
            'link' => 'Ссылка на сайт',
            'likes' => 'Лайки',
            'gallery' => 'Прикрепить изображения'
        ];
    }

    public function upload(){
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        }else{
            return false;
        }
    }

    public function uploadGallery(){
        if ($this->validate()) {
            foreach($this->gallery as $file){
                $path = 'upload/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        }else{
            return false;
        }
    }

    public function isLiked(){
        $user_ip = Yii::$app->request->userIP;//Получение ip юзера
       return (Likes::find()->where(['post_id' => $this->id, 'user_ip' => $user_ip])->one()) ? true : false;//Выборка записи заданного юзера по задан
    }
}
