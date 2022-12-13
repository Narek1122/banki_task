<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Image;
use app\models\UploadForm;
use yii\web\UploadedFile;

class ImageController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {

            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->validate()) {
                foreach ($model->imageFiles as $file) {
                    $fileName = $file->baseName;
                    $image = Image::find()->where(['name' => $fileName . '.' . $file->extension])->one();
                    if ($image) {
                        $fileName .= microtime(true);
                    }
                    $file->saveAs('uploads/' . $fileName . '.' . $file->extension);
                    $img = new Image();
                    $img->name = $fileName . '.' . $file->extension;
                    $img->save();
                }
            }
        }
        $order = $request->get('order');
        $images = Image::find()->orderBy([
            'name' => $order && $order == 'asc' ? SORT_ASC : SORT_DESC,
        ])->all();

        return $this->render('index', ['datas' => $images, 'model' => $model]);
    }


    public function actionUpload()
    {

        $model = new UploadForm();

        if (Yii::$app->request->isPost) {

            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->validate()) {
                foreach ($model->imageFiles as $file) {
                    $fileName = $file->baseName;
                    $image = Image::find()->where(['name' => $fileName])->one();
                    if ($image) {
                        $fileName .= microtime(true);
                    }
                    $file->saveAs('uploads/' . $fileName . '.' . $file->extension);
                    $img = new Image();
                    $img->name = $fileName . '.' . $file->extension;
                    $img->save();
                }
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionDestroy()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');
        $image = Image::find()->where(['id' => $id])->one();
        unlink(Yii::$app->basePath . '/web/uploads/' . $image['name']);
        $image->delete();
        return $this->redirect('/');
    }
}