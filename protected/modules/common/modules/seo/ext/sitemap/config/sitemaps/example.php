<?php
use common\components\helpers\HYii as Y;

return [
    // disabled - значение "true" отключает генерацию карты для данной конфигурации
    'disabled'=>false,
    // disabled - может быть определена как callable функция
    'disabled'=>function() { return false; },
    // prefix - базовый префикс для файлов карты сайта. 
    // Основной префикс "sitemap-" изменить нельзя!
    // Данный параметр дополняет основной префикс: 
    // "sitemap-{prefix}-"
    'prefix'=>'myprefix',
    // prefix - может быть определена как callable функция
    'prefix'=>function() { return 'myprefix'; },
    // вложенные страницы карты сайта
    'items'=>[
        // идентификатор-раздела - будет использован в качестве префикса файлов карты сайта для вложенных элементов
        // в идентификаторе раздела запрещено использовать символ точки.
        // в качестве идентификатора раздела запрещено использовать ключевые слова "root" и "items".
        'идентификатор-раздела'=>[
            // title - наименование раздела. используется для формирования
            // сообщения состояния прогресса генерации карты сайта.
            // "Идет обработка раздела {title}". Если не указан подобное 
            // сообщение отображено не будет.
            'title'=>'Наименование раздела',
            // title - может быть определена как callable функция
            'title'=>function() { return 'Наименование раздела'; },
            // disabled - значение "true" отключает добавление раздела в карту сайта
            'disabled'=>false,
            // disabled - может быть определена как callable функция
            'disabled'=>function() { return false; },
            // prefix - префикс для файлов карты сайта данного раздела. 
            // Данный параметр дополняет базовый префикс (если он задан): 
            // "sitemap-{baseprefix}-{идентификатор-раздела}-{prefix}-"
            'prefix'=>'myitemsprefix',
            // prefix - может быть определена как callable функция
            'prefix'=>function() { return 'myitemsprefix'; },
            // loc - относительный URL страницы
            // если loc не задан, то страницы блока добавлены не будет
            'loc'=>'/path',
            // параметр loc может задан как callable функция 
            // если задан параметр class, то будет передана полученная модель
            // если не задан, то $model будет равна null.
            'loc'=>function($model) { return Y::createUrl('/controller/action', ['id'=>$model->id]); },
            // class - имя класса получения моделей элементов блока
            // параметр не является обязательным
            'class'=>'\My\ClassName',
            // criteria - дополнительный критерий выборки элементов раздела
            'criteria'=>['select'=>'id, update_time'],
            // criteria - может быть задан как callable функция без параметров
            // но которая должна возвращать \CDbCriteria|array
            'criteria'=>function() {
                $criteria=new \CDbCriteria;
                return $criteria;
            },
            // lastmod - последнее время модификации страницы
            // если не указан, то будет использовано время генерации карты сайта.
            // может быть указан атрибут модели из которого получать дату
            // результат должен быть возвращен в формате "YYYY-MM-DD HH:MM:SS".
            'lastmod'=>'update_time',
            // может быть задана, как callable функция
            'lastmod'=>function($model) { return $model->update_time; },
            // changefreq - частота обновления
            // если не указан, то модель будет проверена на наличие 
            // связи "meta" и получения значения из атрибута "changefreq".
            // eсли связи не найдено, или значение в ней не задано, 
            // будет использовано значение, указанное по умолчанию
            // в глобальных настройках карты сайта.
            'changefreq'=>'weekly',
            // может быть задана, как callable функция
            'changefreq'=>function($model) { return $model->meta ? $model->meta->changefreq : null; },
            // priority - приоритет страницы
            // если не указан, то модель будет проверена на наличие 
            // связи "meta" и получения значения из атрибута "priority".
            // eсли связи не найдено, или значение в ней не задано, 
            // будет использовано значение, указанное по умолчанию
            // в глобальных настройках карты сайта.
            'priority'=>1,
            // может быть задана, как callable функция
            'priority'=>function($model) { return $model->meta ? $model->meta->priority : null; },
            // конфигурация вложенных страниц
            'items'=>[
                // конфигурация аналогична базовому параметру "items"
            ]
        ],
    ]
];