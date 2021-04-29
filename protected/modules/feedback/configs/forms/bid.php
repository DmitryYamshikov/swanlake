<?php
/**
 * Обратный звонок
 *
 * 1 Имя
 * 3 Контактный телефон
 */
return array(
    'bid' => array(
        'title' => 'Анкета',
        'short_title' => 'Анкеты',
        // Options
        'options' => array(
            'useCaptcha' => false,
            'sendMail' => true,
            'emptyMessage' => 'Анкет нет',
        ),
        // Form attributes
        'attributes' => array(
            'name' => array(
                'label' => 'Ваши Фамилия, Имя, Отчество',
                'type' => 'String',
                'rules' => array(
                    array('name', 'required')
                ),
            ),
            'phone' => array(
                'label' => 'Контактный телефон',
                'type' => 'Phone',
                'rules' => array(
                    array('phone', 'required')
                ),
            ),
            'messenger' => array(
                'label' => 'Мессенджер',
                'type' => 'String',
                'rules' => array(
                    array('messenger', 'required')
                ),
            ),
            'wechat' => array(
                'label' => 'WeChat',
                'type' => 'String'
            ),
            'email' => array(
                'label' => 'Мессенджер',
                'type' => 'String',
                'rules' => array(
                    array('email', 'required')
                ),
            ),
            'date' => array(
                'label' => 'Ваша дата рождения',
                'type' => 'Date',
                'rules' => array(
                    array('date', 'required')
                ),
            ),
            'education' => array(
                'label' => 'Ваше образование',
                'type' => 'String',
                'rules' => array(
                    array('education', 'required')
                ),
            ),
            'specialty' => array(
                'label' => 'Ваша специальность',
                'type' => 'String',
                'rules' => array(
                    array('specialty', 'required')
                ),
            ),
            'city' => array(
                'label' => 'Город проживания',
                'type' => 'String',
                'rules' => array(
                    array('city', 'required')
                ),
            ),
            'job' => array(
                'label' => 'Место работы/учебы',
                'type' => 'String',
                'rules' => array(
                    array('job', 'required')
                ),
            ),
            'matrial_status' => array(
                'label' => 'Семейное положение',
                'type' => 'String',
                'rules' => array(
                    array('matrial_status', 'required')
                ),
            ),
            'children' => array(
                'label' => 'Дети',
                'type' => 'String',
                'rules' => array(
                    array('children', 'required')
                ),
            ),
            'height' => array(
                'label' => 'Ваш рост',
                'type' => 'String',
                'rules' => array(
                    array('height', 'required')
                ),
            ),
            'weight' => array(
                'label' => 'Ваш вес',
                'type' => 'String',
                'rules' => array(
                    array('weight', 'required')
                ),
            ),
            'heir_color' => array(
                'label' => 'Ваш цвет волос',
                'type' => 'String',
                'rules' => array(
                    array('heir_color', 'required')
                ),
            ),
            'hobby' => array(
                'label' => 'Увлечения, хобби',
                'type' => 'String',
                'rules' => array(
                    array('hobby', 'required')
                ),
            ),
            'positive_feature' => array(
                'label' => 'Ваши положительные черты',
                'type' => 'String',
                'rules' => array(
                    array('positive_feature', 'required')
                ),
            ),
            'negative_feature' => array(
                'label' => 'Ваши отрицательные черты',
                'type' => 'String',
                'rules' => array(
                    array('negative_feature', 'required')
                ),
            ),
            'bad_habits' => array(
                'label' => 'Вредные привычки',
                'type' => 'String',
                'rules' => array(
                    array('bad_habits', 'required')
                ),
            ),
            'foreign_languages' => array(
                'label' => 'Занание иностранных языков и уровень знания',
                'type' => 'String',
                'rules' => array(
                    array('foreign_languages', 'required')
                ),
            ),
            'requirements' => array(
                'label' => 'Требования к партнеру',
                'type' => 'Text',
                'rules' => array(
                    array('requirements', 'required')
                ),
            ),
            'foreigners' => array(
                'label' => 'Знакомство с иностранцами',
                'type' => 'String',
                'rules' => array(
                    array('foreigners', 'required')
                ),
            ),
            'social_network' => array(
                'label' => 'Соцсеть',
                'type' => 'String',
                'rules' => array(
                    array('social_network', 'required')
                ),
            ),
            'сommunication_method' => array(
                'label' => 'Предпочтительный способ связи',
                'type' => 'String',
                'rules' => array(
                    array('сommunication_method', 'required')
                ),
            ),
            'file1' => array(
                'type' => 'String',
                'rules' => array(
                    array('file1', 'required')
                ),
            ),
//            'file2' => array(
//                'type' => 'String',
//                'rules' => array(
//                    array('file2', 'required')
//                ),
//            ),
//            'file3' => array(
//                'type' => 'String',
//                'rules' => array(
//                    array('file3', 'required')
//                ),
//            ),
            'privacy_policy_bid' => array(
                'label' => 'Нажимая на кнопку "Отправить", я даю согласие на ' . \CHtml::link('обработку персональных данных', ['/site/page', 'id'=>\D::cms('privacy_policy')], ['target'=>'_blank']),
                'type' => 'Checkbox',
                'rules' => array(
                    array('privacy_policy_bid', 'required')
                ),
                'htmlOptions'=>['class'=>'inpt inpt-privacy_policy']
            ),
        ),
        // Control buttons
        'controls' => array(
            'send' => array(
                'title' => 'Отправить'
            ),
        ),
    ),
);