<div id="project_payments">
    <table class="table table-striped" style="font-size: 12px">
        <tr>
            <td>
                Стоимость проекта:
            </td>
            <td>
                <input type="text" class="project_price_input" value="<?php echo $model->project_price; ?>"/>
            </td>
            <td>
                Стоимость для автора:
            </td>
            <td>
                <input type="text" class="work_price_input" value="<?php echo $model->work_price; ?>"/>
            </td>
        </tr>
        <tr>
            <td>
                Получено от клиента:
            </td>
            <td>
                <b><span class="payment_received"><?php echo $model->received; ?></span></b>
            </td>
            <td>
                Оплачено работы:
            </td>
            <td>
                <b><span class="payment_payed"><?php echo $model->payed; ?></span></b>
            </td>
            
        </tr>
        <tr>
            <td>
                Выписать счет:
            </td>
            <td>
                <input type="text" class="to_receive_input" value=""/>
            </td>
            <td>
                Отправить на оплату:
            </td>
            <td>
                <input type="text" class="to_pay_input" value=""/>
            </td>
        </tr>
        <tr>
            <td>
                Стоит на оплате:
            </td>
            <td>
                <b><span class="payment_to_receive"><?php echo $model->to_receive; ?></span></b>
            </td>
            <td>
                Суммарно на оплату:
            </td>
            <td>
                <b><span class="payment_to_pay"><?php echo $model->to_pay; ?></span></b>
            </td>
        </tr>
        <tr>
            <td>
                Подтвердить платеж:
            </td>
            <td>
                <div class="btn-group-sm" role="group">
                <button class="btn btn-default send_managers_approve">Подтвердить</button>
                <button class="btn btn-default send_managers_cancel">Отмена</button>
                </div>
            </td>
            <td>
                Сумма платежей:
            </td>
            <td>
                <b><span class="payment_summ"><?php $p = $model->payed + $model->to_pay;
                    echo $p; ?></span></b>
            </td>
        </tr>
        <tr>
            <td>
                
            </td>
            <td>
                <button class="btn btn-primary send_user_payments">Сохранить</button>
            </td>
            <td>
                
            </td>
            <td>
                <button class="btn btn-primary send_author_payments">Сохранить</button>
            </td>
        </tr>
    </table>
    
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var projectPayments = new ProjectPayments(<?php echo $projectId; ?>);
    });
</script>