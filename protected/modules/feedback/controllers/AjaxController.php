<?php

/**
 * Ajax frontend controller
 *
 */

namespace feedback\controllers;

use \AttributeHelper as A;
use \feedback\components\controllers\FrontController;
use \feedback\components\FeedbackFactory;
use common\components\helpers\HEvent;

class AjaxController extends FrontController
{
    /**
     * (non-PHPdoc)
     * @see \feedback\components\controllers\FrontController::filters()
     */
    // @todo filters!
    // 	public function filters()
    // 	{
    // 		return /*\CMap::mergeArray(parent::filters(), */array(
    // 			'ajaxOnly + send'
    // 		)/*)*/;
    // 	}

    /**
     * (non-PHPdoc)
     * @see CController::behaviors()
     */
    public function behaviors()
    {
        return array(
            'AjaxControllerBehavior' => array(
                'class' => '\AjaxControllerBehavior',
            )
        );
    }

    /**
     * Send
     */
    public function actionSend()
    {
        $result['success'] = false;

        $feedbackId = \Yii::app()->request->getParam('feedbackId');
        $formId = \Yii::app()->request->getPost('formId');

        $factory = FeedbackFactory::factory($feedbackId);

        $isAjaxValidation = $this->isAjaxValidation($formId);
        $model = $factory->getModelFactory()->getModel();
        $model->setScenario($isAjaxValidation ? 'active' : 'insert');

        $className = preg_replace('/\\\\+/', '_', get_class($model));
        $values = \Yii::app()->request->getPost($className);

        if ($values) {
            // Задаем значения
            foreach ($factory->getModelFactory()->getAttributes() as $name => $typeFactory) {
                $model->$name = $typeFactory->getModel()->normalize(A::get($values, $name));
            }

            if ($_FILES) {
                $date = date("h-i-s_j-m-y");
                $dir = $_SERVER['DOCUMENT_ROOT'] . "/upload/feedback/";

                if (!is_dir($dir)) {

                    mkdir($dir, 0755, true);
                }
                foreach ($_FILES as $fileArr) {
                    $keys = array_keys($fileArr['name']);

                    foreach ($keys as $key) {
                        if ($fileArr['error'][$key] === UPLOAD_ERR_OK) {
                            $fileTmpPath = $fileArr['tmp_name'][$key];
                            $fileName = $fileArr['name'][$key];
                            $fileSize = $fileArr['size'][$key];
                            $fileType = $fileArr['type'][$key];
                            $fileNameCmps = explode(".", $fileName);
                            $fileExtension = strtolower(end($fileNameCmps));
                            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                            $allowedfileExtensions = array('jpg', 'gif', 'png');
                            $uploadFileDir = $dir . "/";
                            $dest_path = $uploadFileDir . $newFileName;
                            if (in_array($fileExtension, $allowedfileExtensions)) {
                                move_uploaded_file($fileTmpPath, $dest_path);
                            }
                            $model->$key  = $newFileName;
                        }
                    }
                }
            }

            if ($isAjaxValidation) {
                $this->performAjaxValidation($model, $formId);
            } elseif ($model->validate()) {

                $templateOut = $this->renderPartial('//../modules/feedback/views/default/callback', compact([]), true, true);
                $templateOut = strip_tags($templateOut, '<div><p>');
                $templateOut = preg_replace("~[\r\n]~", "", $templateOut);
                $templateOut = preg_replace("/\/\*\*\//", "", $templateOut);

                $result['success'] = $model->save(false);
                $result['message'] = $result['success'] ? 'Ваша заявка принята.' : 'Возникла ошибка на сервере, повторите подачу заявки позже.';
                $result['html'] = $templateOut;
                // Отправка уведомления на почту
                if ($result['success']) {
                    HEvent::raise('OnFeedbackNewMessageSuccess', compact('factory', 'model'));
                }
            }
        }
        echo \CJSON::encode($result);
        \Yii::app()->end();
    }
    public function actionFile()
    {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            //$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
            $uploadFileDir = $_SERVER['DOCUMENT_ROOT'] . "/upload/callback2/";
            $dest_path = $uploadFileDir . $fileName;
            if (in_array($fileExtension, $allowedfileExtensions)) {
                move_uploaded_file($fileTmpPath, $dest_path);
            }
        }
    }
}
