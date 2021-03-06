<?php
namespace extend\modules\slider\widgets;

use common\components\helpers\HYii as Y;

class USlick extends \extend\modules\slider\components\base\USliderWidget
{
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\USliderWidget::$tagOptions
     */
    public $tagOptions=['class'=>'slick__slider'];
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\USliderWidget::$tagOptions
     */
    public $itemsTagName='div';
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\USliderWidget::$itemsOptions
     */
    public $itemsOptions=['class'=>'slick__slider-items'];
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\USliderWidget::$tagOptions
     */
    public $itemTagName='div';
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\USliderWidget::$itemOptions
     */
    public $itemOptions=['class'=>'slick__slider-item'];
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\USliderWidget::$config
     */
    public $config='default';
 
    /**
     * @var string имя шаблона представления по умолчанию.
     */
    public $view='udefault';    
    
    /**
     * {@inheritDoc}
     * @see \extend\modules\slider\components\base\USliderWidget::init()
     */
    public function init()
    {
        parent::init();
        
        if($this->jsLoad) { 
            Y::jsCore('slick');
        }
        
        $this->registerScript('$("'.$this->getJQueryItemsSelector().'").slick('.\CJavaScript::encode($this->options).');');
    }
}