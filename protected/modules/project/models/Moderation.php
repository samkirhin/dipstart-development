<?php

/**
 * This is the model class for table "Projects".
 *
 * The followings are the available columns in table 'Projects':
 * @property string $id
 * @property integer $order_id
 * @property string $user_id
 * @property integer $category_id
 * @property integer $job_id
 * @property string $title
 * @property string $text
 * @property string $date
 * @property string $max_exec_date
 * @property string $date_finish
 * @property integer $pages
 * @property string $add_demands
 * @property integer $status
 * @property string $executor
 * @property integer $event_creator_id
 * @property integer $timestamp
 */
class Moderation extends CActiveRecord
{

    public $dateTimeIncomeFormat = 'yyyy-MM-dd HH:mm:ss';
    public $dateTimeOutcomeFormat = 'dd.MM.yyyy HH:mm';
    public $dateIncomeFormat = 'yyyy-MM-dd HH:mm:ss';
    public $dateOutcomeFormat = 'dd.MM.yyyy';

    public function getDbdate_finishstart(){
        if ($this->date_finishstart!='') {
            return Yii::app()->dateFormatter->format($this->dateOutcomeFormat, CDateTimeParser::parse($this->date_finishstart, $this->dateTimeIncomeFormat));
        }
    }
    public function setDbdate_finishstart($datetime)
    {
        if ($datetime!=''){
            $this->date_finishstart = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateOutcomeFormat));
        }
    }
    public function getDbdate_finishend(){
        if ($this->date_finishend!='') {
            return Yii::app()->dateFormatter->format($this->dateOutcomeFormat, CDateTimeParser::parse($this->date_finishend, $this->dateTimeIncomeFormat));
        }
    }
    public function setDbdate_finishend($datetime)
    {
        if ($datetime!=''){
            $this->date_finishend = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateOutcomeFormat));
        }
    }
    public function getDbdate()
    {
        if ($this->date!='') {
            if ($this->date=='0000-00-00 00:00:00') return '';
            if (strlen($this->date) == 19) return Yii::app()->dateFormatter->format($this->dateTimeOutcomeFormat, CDateTimeParser::parse($this->date, $this->dateTimeIncomeFormat));
            elseif (strlen($this->date) == 10) return Yii::app()->dateFormatter->format($this->dateOutcomeFormat, CDateTimeParser::parse($this->date, $this->dateTimeIncomeFormat));
        }
    }
    public function getDbmax_exec_date()
    {
        if ($this->max_exec_date!='') {
            if ($this->max_exec_date=='0000-00-00 00:00:00') return '';
            if (strlen($this->max_exec_date) == 19) return Yii::app()->dateFormatter->format($this->dateTimeOutcomeFormat, CDateTimeParser::parse($this->max_exec_date, $this->dateTimeIncomeFormat));
            elseif (strlen($this->max_exec_date) == 10) return Yii::app()->dateFormatter->format($this->dateOutcomeFormat, CDateTimeParser::parse($this->max_exec_date, $this->dateTimeIncomeFormat));
        }
    }
    public function getDbmanager_informed()
    {
        if ($this->manager_informed!='') {
            if ($this->manager_informed=='0000-00-00 00:00:00') return '';
            if (strlen($this->manager_informed) == 19) return Yii::app()->dateFormatter->format($this->dateTimeOutcomeFormat, CDateTimeParser::parse($this->manager_informed, $this->dateTimeIncomeFormat));
            elseif (strlen($this->manager_informed) == 10) return Yii::app()->dateFormatter->format($this->dateOutcomeFormat, CDateTimeParser::parse($this->manager_informed, $this->dateTimeIncomeFormat));
        }
    }
    public function getDbdate_finish()
    {
        if ($this->date_finish!='') {
            if ($this->date_finish=='0000-00-00 00:00:00') return '';
            if (strlen($this->date_finish) == 19) return Yii::app()->dateFormatter->format($this->dateTimeOutcomeFormat, CDateTimeParser::parse($this->date_finish, $this->dateTimeIncomeFormat));
            elseif (strlen($this->date_finish) == 10) return Yii::app()->dateFormatter->format($this->dateOutcomeFormat, CDateTimeParser::parse($this->date_finish, $this->dateTimeIncomeFormat));
        }
    }
    public function getDbauthor_informed()
    {
        if ($this->author_informed!='') {
            if ($this->author_informed=='0000-00-00 00:00:00') return '';
            if (strlen($this->author_informed) == 19) return Yii::app()->dateFormatter->format($this->dateTimeOutcomeFormat, CDateTimeParser::parse($this->author_informed, $this->dateTimeIncomeFormat));
            elseif (strlen($this->author_informed) == 10) return Yii::app()->dateFormatter->format($this->dateOutcomeFormat, CDateTimeParser::parse($this->author_informed, $this->dateTimeIncomeFormat));
        }
    }
    public function setDbmax_exec_date($datetime)
    {
        if ($datetime!=''){
            if (strlen($datetime) == 16) $this->max_exec_date = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateTimeOutcomeFormat));
            elseif (strlen($datetime) == 10) $this->max_exec_date = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateOutcomeFormat));
        }
    }
    public function setDbdate_finish($datetime)
    {
        if ($datetime!=''){
            if (strlen($datetime) == 16) $this->date_finish = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateTimeOutcomeFormat));
            elseif (strlen($datetime) == 10) $this->date_finish = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateOutcomeFormat));
        }
    }
    public function setDbdate($datetime)
    {
        if ($datetime!=''){
            if (strlen($datetime) == 16) $this->date = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateTimeOutcomeFormat));
            elseif (strlen($datetime) == 10) $this->date = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateOutcomeFormat));
        }
    }
    public function setDbmanager_informed($datetime)
    {
        if ($datetime!=''){
            if (strlen($datetime) == 16) $this->manager_informed = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateTimeOutcomeFormat));
            elseif (strlen($datetime) == 10) $this->manager_informed = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateOutcomeFormat));
        }
    }
    public function setDbauthor_informed($datetime)
    {
        if ($datetime!=''){
            if (strlen($datetime) == 16) $this->author_informed = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateTimeOutcomeFormat));
            elseif (strlen($datetime) == 10) $this->author_informed = Yii::app()->dateFormatter->format($this->dateTimeIncomeFormat, CDateTimeParser::parse($datetime, $this->dateOutcomeFormat));
        }
    }
    public function init()
    {
        parent::init();
        
        $this->status = 1;
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ZakazModeration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, category_id, job_id, pages, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('executor', 'length', 'max'=>10),
            array('text, max_exec_date, date_finish, author_informed, manager_informed, date, add_demands, notes, author_notes, time_for_call, edu_dep', 'safe'),
            array('dbmax_exec_date, dbdate_finish, dbauthor_informed, dbmanager_informed, dbdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, category_id, job_id, title, text, date, max_exec_date, date_finish, author_informed, manager_informed, pages, add_demands, status, executor, event_creator_id, timestamp', 'safe'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'ID',
            'order_id' => 'Order ID',
            'user_id' => ProjectModule::t('User'),
            'category_id' => ProjectModule::t('Category'),
            'job_id' => ProjectModule::t('Job'),
            'title' => ProjectModule::t('Title'),
            'text' => ProjectModule::t('Text'),
            'date' => ProjectModule::t('Date'),
            'max_exec_date' => ProjectModule::t('Max Date'),
            'date_finish' => ProjectModule::t('Date Finish'),
            'pages' => ProjectModule::t('Pages'),
            'add_demands' => ProjectModule::t('Add Demands'),
            'status' => ProjectModule::t('Status'),
            'executor' => ProjectModule::t('Executor'),
            'manager_informed' => ProjectModule::t('Manager Informed'),
            'author_informed' => ProjectModule::t('Author Informed'),
            'notes' => ProjectModule::t('Notes'),
            'author_notes' => ProjectModule::t('author_notes'),
            'event_creator_id' => ProjectModule::t('Event Creator'),
            'timestamp' => ProjectModule::t('timestamp'),
            'time_for_call' => ProjectModule::t('time_for_call'),
            'edu_dep' => ProjectModule::t('edu_dep'),
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

		$criteria->compare('id',$this->id,true);
        $criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('max_exec_date',$this->max_exec_date,true);
		$criteria->compare('date_finish',$this->date_finish,true);
		$criteria->compare('pages',$this->pages);
		$criteria->compare('budget',$this->budget,true);
		$criteria->compare('add_demands',$this->add_demands,true);
		$criteria->compare('is_payed',$this->is_payed);
		$criteria->compare('with_prepayment',$this->with_prepayment);
		$criteria->compare('status',$this->status);
		$criteria->compare('executor',$this->executor,true);
        $criteria->compare('event_creator_id',$this->event_creator_id,true);
        $criteria->compare('timestamp',$this->timestamp,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getExecutor($orderId)
    {
        return self::model()->findByPk($orderId)->executor;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zakaz the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
