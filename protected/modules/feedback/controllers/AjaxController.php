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
                            $allowedfileExtensions = array('jpg', 'gif', 'png');
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
//                    HEvent::raise('OnFeedbackNewMessageSuccess', compact('factory', 'model'));
                    $filename = $dest_path; //Имя файла для прикрепления
                    $to = "Lukichev_s@mail.ru"; //Кому
                    $from = "def@gmail.com"; //От кого
                    $subject = "Test"; //Тема
                    $message = "Текстовое сообщение"; //Текст письма
                    $boundary = "---"; //Разделитель
                    /* Заголовки */
                    $headers = "From: $from\nReply-To: $from\n";
                    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";
                    $body = "--$boundary\n";
                    /* Присоединяем текстовое сообщение */
                    $body .= "Content-type: text/html; charset='utf-8'\n";
                    $body .= "Content-Transfer-Encoding: quoted-printablenn";
                    $body .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
                    $body .= $message."\n";
                    $body .= "--$boundary\n";
                    $file = fopen($filename, "r"); //Открываем файл
                    $text = fread($file, filesize($filename)); //Считываем весь файл
                    fclose($file); //Закрываем файл
                    /* Добавляем тип содержимого, кодируем текст файла и добавляем в тело письма */
                    $body .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode($filename)."?=\n";
                    $body .= "Content-Transfer-Encoding: base64\n";
                    $body .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
                    $body .= chunk_split(base64_encode($text))."\n";
                    $body .= "--".$boundary ."--\n";
                    mail($to, $subject, $body, $headers); //Отправляем письмо
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
