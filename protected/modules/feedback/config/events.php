<?php

/**
 * Дополнительные события модуля Обратная связь
 *
 * Список событий модуля "Обратная связь"
 *
 * "OnFeedbackNewMessageSuccess" - новое сообщение (параметры: $factory, $model)
 *
 */

use common\ext\email\components\helpers\HEmail;

return [
    'OnFeedbackNewMessageSuccess' => [
        function ($event) {
            $id = $event->params['factory']->id;
            $filePath = [];
            foreach ($event->params['factory']->config[$id]['attributes'] as $key => $attribute) {
                if ($attribute['type'] == 'File') {
                    $filePath[] =  $_SERVER['DOCUMENT_ROOT'] . "/upload/feedback/" . $event->params['model'][$key];
                }
            }
            HEmail::cmsAdminSend(
                true,
                [
                    'factory' => $event->params['factory'],
                    'model' => $event->params['model'],
                ],
                'feedback.views._email.new_message_success',
                false,
                null,
                $filePath
            );
        }
    ]
];
