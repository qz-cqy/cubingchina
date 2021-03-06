<?php

/**
 * This is the model class for table "RanksSingle".
 *
 * The followings are the available columns in table 'RanksSingle':
 * @property integer $id
 * @property string $personId
 * @property string $eventId
 * @property integer $best
 * @property integer $worldRank
 * @property integer $continentRank
 * @property integer $countryRank
 */
class RanksSingle extends ActiveRecord {
	public $medals = array(
		'gold'=>0,
		'silver'=>0,
		'bronze'=>0,
	);

	//获取average数据
	public function average($attribute) {
		if($this->average == null) {
			return '';
		}
		if($attribute == 'best') {
			return CHtml::link(Results::formatTime($this->average->$attribute, $this->eventId), array(
				'/results/rankings',
				'event'=>$this->eventId,
				'type'=>'average',
				'region'=>$this->person->countryId,
			));
		}
		return $this->average->getRank($attribute);
	}

	public function getRank($attribute) {
		if ($this->$attribute <= 0) {
			return '-';
		}
		if ($this->$attribute <= 10) {
			return CHtml::tag('span', array('class'=>'top10'), $this->$attribute);
		}
		return $this->$attribute;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'RanksSingle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('best, worldRank, continentRank, countryRank', 'numerical', 'integerOnly'=>true),
			array('personId', 'length', 'max'=>10),
			array('eventId', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, personId, eventId, best, worldRank, continentRank, countryRank', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'person'=>array(self::BELONGS_TO, 'Persons', 'personId', 'on'=>'person.subid=1'),
			'event'=>array(self::BELONGS_TO, 'Events', 'eventId'),
			'average'=>array(self::BELONGS_TO, 'RanksAverage', array(
				'personId'=>'personId',
				'eventId'=>'eventId',
			)),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('RanksSingle', 'ID'),
			'personId' => Yii::t('RanksSingle', 'Person'),
			'eventId' => Yii::t('RanksSingle', 'Event'),
			'best' => Yii::t('RanksSingle', 'Best'),
			'worldRank' => Yii::t('RanksSingle', 'World Rank'),
			'continentRank' => Yii::t('RanksSingle', 'Continent Rank'),
			'countryRank' => Yii::t('RanksSingle', 'Country Rank'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('personId',$this->personId,true);
		$criteria->compare('eventId',$this->eventId,true);
		$criteria->compare('best',$this->best);
		$criteria->compare('worldRank',$this->worldRank);
		$criteria->compare('continentRank',$this->continentRank);
		$criteria->compare('countryRank',$this->countryRank);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection() {
		return Yii::app()->wcaDb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RanksSingle the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
}
