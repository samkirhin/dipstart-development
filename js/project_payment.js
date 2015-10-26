var ProjectPayments = function(orderId) {
    var self = this;
    this.form = $('#project_payments');
    this.orderId = orderId;
    
    /* Привязка имен */
    this.p_price = this.form.find('.project_price_input');
    this.w_price = this.form.find('.work_price_input');
    this.t_pay = this.form.find('.to_pay_input');
    this.t_receive = this.form.find('.to_receive_input');
    this.payment_received = this.form.find('.payment_received');
    this.payed = this.form.find('.payment_payed');
    this.to_receive = this.form.find('.payment_to_receive');
    this.to_pay = this.form.find('.payment_to_pay');
    
    this.sendPayments = function() {
        var proj_price = self.p_price.val();
        var work_price = self.w_price.val();
        var receive = self.t_receive.val();
        var pay = self.t_pay.val();
		
        if (proj_price!='') {
            $.post('/project/payment/savePayments', JSON.stringify({
            'order_id': self.orderId,
            'project_price': proj_price,
            'to_receive': receive,
            'work_price': work_price,
            'to_pay': pay
        }), function (response) {
            if (response.data) {
                self.t_receive.val('');
                self.p_price.val(response.data.project_price);
                self.to_receive.text(response.data.to_receive);
                self.t_pay.val('');
                self.w_price.val(response.data.work_price);
                self.to_pay.text(response.data.to_pay);
            } else {
                alert(response);
            }
        }, 'json');}
		//alert('pay='+pay);
		if (pay>0)	send_message(24,'Исполнителю об оплате заказа',pay);
		
        /*if (receive!='') {$.post('/project/payment/savePaymentsToUser', JSON.stringify({
            'order_id': self.orderId,
            'project_price': proj_price,
            'to_receive': receive
        }), function (response) {
            if (response.data) {
                self.t_receive.val('');
                self.p_price.val(response.data.project_price);
                self.to_receive.text(response.data.to_receive);
            } else {
            }
        }, 'json');}
        else
        {$.post('/project/payment/savePaymentsToAuthor', JSON.stringify({
            'order_id': self.orderId,
            'work_price': work_price,
            'to_pay': pay
        }), function (response) {
            if (response.data) {
                self.t_pay.val('');
                self.w_price.val(response.data.work_price);
                self.to_pay.text(response.data.to_pay);
            } else {
            }
        }, 'json');}*/
        
    };
    
    self.form.find('.send_user_payments').on('click', function() {
        self.sendPayments();
        
    });
    
    self.form.find('.send_managers_approve'). on('click', function() {
        $.post('/project/payment/managersApprove', JSON.stringify({
            'order_id': self.orderId
        }), function (response) {
            if (response.data) {
                self.payment_received.text(response.data.received);
                self.to_receive.text(0);
            } else {
            }
        }, 'json');
		// уведомление выдаётся, даже если система оплаты даёт ошибку
		send_message(13,'Заказчику об оплате когда выставлен счет',0);
    });
    
    self.form.find('.send_managers_cancel'). on('click', function() {
        $.post('/project/payment/managersCancel', JSON.stringify({
            'order_id': self.orderId
        }), function (response) {
            if (response.data) {
                self.to_receive.text(response.data.to_receive);
            } else {
            }
        }, 'json');
    });
}