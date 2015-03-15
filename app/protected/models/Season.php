<?php

/**
 * This is the model class for table "season".
 *
 * The followings are the available columns in table 'season':
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $updated
 * @property integer $series_id
 *
 * The followings are the available model relations:
 * @property Episode[] $episodes
 * @property Series $series
 */
class Season extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('updated', 'required'),
			array('series_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>64),
			array('url', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, url, updated, series_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'episodes' => array(self::HAS_MANY, 'Episode', 'season_id'),
			'series' => array(self::BELONGS_TO, 'Series', 'series_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'url' => 'Url',
			'updated' => 'Updated',
			'series_id' => 'Series',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('series_id',$this->series_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Season the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
