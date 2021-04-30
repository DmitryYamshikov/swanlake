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
            $fileNameForMail = [];
            if ($_FILES) {
                $date = date("h-i-s_j-m-y");
                $dir = $_SERVER['DOCUMENT_ROOT'] . "/upload/feedback/";

                if (!is_dir($dir)) {

                    mkdir($dir, 0755, true);
                }
                foreach ($_FILES as $fileArr) {
                    $keys = array_keys($fileArr['name']);

                    foreach ($keys as $item => $key) {
                        if ($fileArr['error'][$key] === UPLOAD_ERR_OK) {
                            $fileTmpPath = $fileArr['tmp_name'][$key];
                            $fileName = $fileArr['name'][$key];
                            $fileSize = $fileArr['size'][$key];
                            $fileType = $fileArr['type'][$key];
                            $fileNameCmps = explode(".", $fileName);
                            $fileExtension = strtolower(end($fileNameCmps));
                            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
                            $uploadFileDir = $dir . "/";
                            $dest_path = $uploadFileDir . $newFileName;
                            if (in_array($fileExtension, $allowedfileExtensions)) {
                                move_uploaded_file($fileTmpPath, $dest_path);
                            }
                            $fileNameForMail[$item] = $dest_path;
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
//                    $filenames[0] = $fileNameForMail[0]; //Имя файла для прикрепления
//                    $filenames[1] = $fileNameForMail[1]; //Имя файла для прикрепления
//                    $filenames[2] = $fileNameForMail[2]; //Имя файла для прикрепления
//
//                    $this->sendFiles($filenames, 'Lukichev_s@mail.ru', $model);
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


    private function sendFiles($filesArray, $emailTo, $model){

        $files = $filesArray;
        $headers = 'Content-type: text/plain; charset="utf-8"';
        $to = $emailTo;
        $from = "example@gmail.com";
        $subject = 'Новое сообщение с сайта ' . \D::cms('sitename', $_SERVER['SERVER_NAME']);
        $message = "";

        $correctModel = [];

        foreach ($model as $key => $value)
        {
            if ($key == 'id' || $key == 'created' || $key == 'completed' || $key == 'file1' || $key == 'file2' || $key == 'file3')
            {
                continue;
            } else
            {
                $correctModel[$key] = $value;
            }
        }

        foreach ($correctModel as $key => $item)
        {
            $message .= $key . " : " . $item . "\n";
        }

        $message = $this->convertEncoding($message);

        // boundary
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        // headers for attachment
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // multipart boundary
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
        $message .= "--{$mime_boundary}\n";

        // preparing attachments
        for($x=0;$x<count($files);$x++){
            $file = fopen($files[$x],"rb");
            $data = fread($file,filesize($files[$x]));
            fclose($file);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$files[$x]\"\n" .
                "Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            $message .= "--{$mime_boundary}\n";
        }

        // send

        $ok = @mail($to, $subject, $message, $headers);
    }

    private function convertEncoding($str, $from = 'auto', $to = "UTF-8") {
        if($from == 'auto') $from = mb_detect_encoding($str);
        return mb_convert_encoding ($str , $to, $from);
    }
}
