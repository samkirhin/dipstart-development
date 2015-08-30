<?php

/**
 * This is the model class for table "Payment".
 *
 * The followings are the available columns in table 'Payment':
 * @property integer $id
 * @property integer $order_id
 * @property string $receive_date
 * @property string $pay_date
 * @property string $theme
 * @property string $manager
 * @property string $user
 * @property double $summ
 * @property string $details_ya
 * @property string $details_wm
 * @property string $details_bank
 * @property integer $payment_type
 * @property integer $approve
 * @property string $method
 */
class Payment extends CActiveRecord
{
	public static $table_prefix;
	
	public function tableName() {
		if(isset(self::$table_prefix))
			return self::$table_prefix.'Payment';
		else
			return 'Payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, order_id, payment_type, approve', 'numerical', 'integerOnly'=>true),
			array('summ', 'numerical'),
			array('theme, details_ya, details_wm', 'length', 'max'=>255),
			array('manager, user, method', 'length', 'max'=>100),
                        array('manager, user', 'email'),
			array('receive_date, pay_date, details_bank', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_id, receive_date, pay_date, theme, manager, user, summ, details_ya, details_wm, details_bank, payment_type, approve, method', 'safe', 'on'=>'search'),
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
			'order_id' => 'Номер заказа',
			'receive_date' => 'Дата получения',
			'pay_date' => 'Дата оплаты',
			'theme' => 'Тема',
			'manager' => 'Менеджер',
			'user' => 'Пользователь',
			'summ' => 'Сумма',
			'details_ya' => 'Яндекс.Деньги',
			'details_wm' => 'WebMoney',
			'details_bank' => 'Реквизиты банка',
			'payment_type' => 'Тип платежа',
			'approve' => 'Подтверждение',
			'method' => 'Способ оплаты',
		);
	}

        public function approveFromBookkeeper($method) {    
            if($this->approve != 1){
				$tran = Yii::app()->db->beginTransaction();
				try {
					
					$this->method = $method;
					$this->approve = 1;
					$this->pay_date = date("Y-m-d");
					$this->save(false);
					if($this->payment_type == 1) {
						$payment = ProjectPayments::model()->findByAttributes(['order_id' => $this->order_id]);
						$payment->payed += $this->summ;
						$payment->to_pay -= $this->summ;
						$payment->save(false);
					}
					$tran->commit();
					
				} catch (Exception $ex) {
					$tran->rollback();
					return false;
				}
				return true;
            } else return false;
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('receive_date',$this->receive_date,true);
		$criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('theme',$this->theme,true);
		$criteria->compare('manager',$this->manager,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('summ',$this->summ);
		$criteria->compare('details_ya',$this->details_ya,true);
		$criteria->compare('details_wm',$this->details_wm,true);
		$criteria->compare('details_bank',$this->details_bank,true);
		$criteria->compare('payment_type',$this->payment_type);
		$criteria->compare('approve',$this->approve);
		$criteria->compare('method',$this->method,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
