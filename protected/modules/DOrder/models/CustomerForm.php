<?php
/**
 * Модель формы покупателя.
 *
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property text $address
 * @property text $comment
 * @property integer $payment
 */
namespace DOrder\models;

use common\components\helpers\HArray as A;
use common\components\helpers\HYii as Y;

class CustomerForm extends \common\components\base\FormModel
{
//	public $name;
//	public $email;
//	public $phone;
//	public $address;
//	public $comment;
	public $payment;
	public $paymentType;
	public $privacy_policy;
	
	/**
	 * @param string $className form model class name.
	 * @return CustomerForm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors()
	{
		return A::m(parent::behaviors(), [

		]);
	}

	/**
	 * Получить аттрибуты
	 * @see CModel::getAttributes()
	 * @param mixed $names
	 * @param boolean $returnALV Возвращать результат в виде массива 
	 * array(attribute=>array('label' => label, 'value' => value)), или 
	 * в виде простого array(name=>value)
	 * @param boolean $serialize Сериализовать результат или нет.
	 * @param boolean $filter_html_tags Обрабвтывать ли пришедшие параметры на наличие html.
	 * 
	 * @return array|string возвращается строка, если параметр $serialize установлен в true.
	 */
	public function getAttributes($names=null, $returnALV=false, $serialize=false, $filter_html_tags = false) 
	{
		//$attributes = parent::getAttributes($names);

		$values=array();
		if ($filter_html_tags) {
			foreach ($this->getSafeAttributeNames() as $name) {
				$values[$name] = \CHtml::encode($this->$name);
			}
		} else {
			foreach ($this->getSafeAttributeNames() as $name) {
				$values[$name] = $this->$name;
			}
		}

		if (is_array($names)) {
			$values2=array();
			foreach ($names as $name) {
				$values2[$name] = isset($values[$name]) ? $values[$name] : null;
			}
			$attributes = $values2;
		} else {
			$attributes = $values;
		}

		if($returnALV) {
			$labels = $this->attributeLabels();
			foreach($attributes as $name=>$value) {
				$attributes[$name] = array('label' => A::get($labels, $name, $name), 'value' => $value);
			}	
		}

		return $serialize ? serialize($attributes) : $attributes;
	}

	public function getPaymentTypes()
	{
		$items = array();
	
		if ($this->scenario=='payment') {
			foreach(Y::param('payment.types') as $index=>$title) {
				$items[$index] = $title;
			}
		}
	
		return $items;
	}

	//////////////////////////////////////////////////

	public function afterConstruct()
	{
		parent::afterConstruct(); // TODO: Change the autogenerated stub
		$criteria = new \CDbCriteria();
		$criteria->order = 'sort ASC';
		/** @var OrderCustomerFields[] $fieldsObj */
		$fieldsObj = OrderCustomerFields::model()->findAll($criteria);
		$fieldsArr = array();
		if ($fieldsObj) {
			foreach ($fieldsObj as $obj) {
				$fieldsArr[] = $obj->getField();
			}
		}
		$this->setFields($fieldsArr);
	}

	private $_fieldsByKeys;
	private $_fields;
	private $_rules = array();
	private $_properties;

	public function setFields($fields) {
		$rules = array();
		$properties = array();
		foreach ($fields as $key => $field) {
			$fieldName = $field['name'];
			$properties[$fieldName] = isset($field['value']) ? $field['value'] : '';
			if (count($field['validation'])) {
				foreach ($field['validation'] as &$validation_row) {
					$params = array($fieldName, $validation_row['type']);
					if (isset($validation_row['params']) && is_array($validation_row['params'])) {
						$params = array_merge($params, $validation_row['params']);
					}
					$rules[] = $params;
				}
			} else {
				$rules[] = array($fieldName, 'safe');
			}
			$this->_fieldsByKeys[$fieldName] = $field;
		}

		$this->_fields = $fields;
		$this->_properties = $properties;
		$this->_rules = $rules;
	}

	public function getFields() {
		return $this->_fields;
	}

	public function rules() {
		/*return array(
			array('name, phone', 'required'),
			array('name', 'length', 'max'=>50),
			array('email, address', 'length', 'max'=>255),
			array('email', 'email'),
			array('phone', 'match', 'pattern'=>'/^\+7 \( \d{3} \) \d{3} - \d{2} - \d{2}$/'),
			array('comment', 'length', 'max'=>1000),
//			array('payment', 'numerical', 'integerOnly'=>true, 'on'=>'payment'),
//			array('payment', 'required', 'on'=>'payment', 'message'=>'Необходимо выбрать способ оплаты'),
//			array('paymentType', 'length', 'max'=>32),
		);*/
		return $this->getRules(A::m($this->_rules,[
			['privacy_policy', 'requiredPrivacyPolicy'],
			['privacy_policy', 'safe'],
		]));
	}
	
	public function requiredPrivacyPolicy($attribute)
	{
		if($this->$attribute != 1) {
			$this->addError($attribute, 'Вы не подтвердили свое согласие');
		}
	}

	public function getProperties() {
		return $this->_properties;
	}

	public function getFieldsByKeys() {
		return $this->_fieldsByKeys;
	}


	public function unmask($name, $value) {
		if (isset($this->_fieldsByKeys[$name]) &&
			(isset($this->_fieldsByKeys[$name]['mask']) && $mask = $this->_fieldsByKeys[$name]['mask'])
		)
		{
			$value = self::unmaskField($mask, $value);
		}
		return $value;
	}

	public static function unmaskField($mask, $value) {
		if (strlen($value) !== strlen($mask)) {
			return $value;
		}
		$value = str_split($value);
		$result = "";
		foreach ($value as $index => $chr) {
			if ($mask[$index] === '9' || $mask[$index] == 'a') {
				$result .= $chr;
			}
		}
		$value = $result;
		return $value;
	}

	public function getMaskedText($name) {
		$value = $this->_properties[$name];
		if (isset($this->_fieldsByKeys[$name]) && ($mask = $this->_fieldsByKeys[$name]['mask'])) {
			$k = 0;
			for ($i = 0; $i < strlen($mask); $i++) {
				if ($mask[$i] == '9' || $mask[$i] == 'a') {
					if (isset($value[$k])) {
						$mask[$i] = $value[$k];
						$k++;
					} else {
						$mask[$i] = '';
						$k++;
					}
				}
			}
			$value = $mask;
		}
		return $value;
	}

	public function setProperty($name, $value){
		if (isset($this->_properties[$name])) {
			$this->_properties[$name] = $value;
		}
	}

	public function __get($name) {
		if (isset($this->_properties[$name])) {
			return $this->_properties[$name];
		}
		return parent::__get($name);
	}

	public function __set($name, $value) {
		$value = $this->unmask($name, $value);
		if (isset($this->_fieldsByKeys[$name])
			&& (isset($this->_fieldsByKeys[$name]['type'])
				&& ($this->_fieldsByKeys[$name]['type']) == 'number')
		) {
			$value = (float)$value;
		}
		if (isset($this->_properties[$name])) {
			return $this->_properties[$name] = $value;
		}
		//todo: check this
		try {
			return parent::__set($name, $value);
		} catch (\Exception $e) {
			return null;
		}
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		/*return array(
			'name' => 'Ваше имя',
			'email' => 'E-mail',
			'phone' => 'Телефон',
			'address' => 'Адрес доставки',
			'comment' => 'Комментарий к заказу',
			'create_time' => 'Время создания',
//			'payment'=>'Способы оплаты'
		);*/
		$result = array(
			'privacy_policy'=>'Подтверждаю свое согласие с ' . \CHtml::link('Политикой обработки данных', ['/site/page', 'id'=>\D::cms('privacy_policy')], ['target'=>'_blank']),
		);
		foreach ($this->getFields() as $v) {
			$result[$v['name']] = $v['title'];
		}
		return $this->getAttributeLabels($result);
	}

	public function getEmailForNotification() {
	    /** @var OrderCustomerFields $email_field */
	    $email_field = OrderCustomerFields::model()->findByAttributes([
	        'type' => OrderCustomerFields::TYPE_EMAIL
        ]);
	    if ($email_field) {
	        $attribute = $email_field->name;
	        return $this->$attribute;
        }
        return null;
    }

}
