<?php

class EventsForm extends Widget {
	public $model;
	public $name = 'events';
	public $events = array();
	public $type = 'checkbox';
	public $fee = false;
	public $htmlOptions = array();
	public $labelOptions = array();
	public $numberOptions = array();
	public $feeOptions = array();
	public function run() {
		$events = $this->events;
		foreach ($events as $key=>$value) {
			$events[$key] = Yii::t('event', $value);
		}
		$model = $this->model;
		$name = $this->name;
		$type = $this->type;
		$htmlOptions = $this->htmlOptions;
		$labelOptions = $this->labelOptions;
		$numberOptions = $this->numberOptions;
		$feeOptions = $this->feeOptions;
		if ($this->type == 'checkbox') {
			echo CHtml::openTag('div', $htmlOptions);
			foreach ($events as $event=>$value) {
				echo CHtml::openTag('label', array(
					'class'=>'checkbox-inline',
				));
				echo CHtml::checkBox(CHtml::activeName($model, $name . '[]'), in_array("$event", $model->$name), array(
					'value'=>$event,
				));
				echo $value;
				echo CHtml::closeTag('label');
				echo '<br>';
			}
			echo CHtml::closeTag('div');
		} else {
			if (!isset($htmlOptions['class'])) {
				$htmlOptions['class'] = 'row';
			} else {
				$htmlOptions['class'] .= ' row';
			}
			if (!isset($numberOptions['class'])) {
				$numberOptions['class'] = 'form-control';
			} else {
				$numberOptions['class'] .= ' form-control';
			}
			if (!isset($feeOptions['class'])) {
				$feeOptions['class'] = 'form-control';
			} else {
				$feeOptions['class'] .= ' form-control';
			}
			if (!isset($labelOptions['class'])) {
				$labelOptions['class'] = 'text-right col-lg-2 col-xs-3';
			} else {
				$labelOptions['class'] .= ' text-right col-lg-2 col-xs-3';
			}
			echo CHtml::openTag('div', $htmlOptions);
			foreach ($events as $key=>$value) {
				echo CHtml::openTag('div', array(
					'class'=>'col-lg-6',
				));
				echo CHtml::openTag('div', array(
					'class'=>'row',
				));
				//label
				$labelOptions['label'] = $value . ': ';
				echo CHtml::activeLabelEx($model, "{$name}[{$key}][round]", $labelOptions);
				//round
				echo CHtml::openTag('div', array(
					'class'=>'col-lg-5 col-xs-4',
				));
				echo CHtml::openTag('div', array(
					'class'=>'input-group',
				));
				echo CHtml::activeNumberField($model, "{$name}[{$key}][round]", $numberOptions);
				echo CHtml::tag('span', array('class'=>'input-group-addon'), Yii::t('common', 'Rounds'));
				echo CHtml::closeTag('div');
				echo CHtml::closeTag('div');
				//fee
				if ($this->fee === true) {
					echo CHtml::openTag('div', array(
						'class'=>'col-lg-5 col-xs-4',
					));
					echo CHtml::openTag('div', array(
						'class'=>'input-group',
					));
					echo CHtml::activeNumberField($model, "{$name}[{$key}][fee]", $feeOptions);
					echo CHtml::tag('span', array('class'=>'input-group-addon'), Yii::t('common', 'CNY'));
					echo CHtml::closeTag('div');
					echo CHtml::closeTag('div');
				}
				echo CHtml::closeTag('div');
				echo CHtml::closeTag('div');
			}
			echo CHtml::closeTag('div');
		}
	}
}