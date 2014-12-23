<div class="project_payments">
    <table class="table table-striped" style="font-size: 12px">
        <tr>
            <td>
                Стоимость:
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
                <b><?php echo $model->received; ?></b>
            </td>
            <td>
                Отправить оплату:
            </td>
            <td>
                <input type="text" class="to_pay_input" value=""/>
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
                Сумма на оплату:
            </td>
            <td>
                <b><?php echo $model->to_pay; ?></b>
            </td>
        </tr>
        <tr>
            <td>
                Стоит на оплате:
            </td>
            <td>
                <b><?php echo $model->to_receive; ?></b>
            </td>
            <td>
                Оплачено:
            </td>
            <td>
                <b><?php echo $model->payed; ?></b>
            </td>
        </tr>
        <tr>
            <td>
                Сумма на подтверждение:
            </td>
            <td>
                <b><?php echo $model->received; ?></b>
            </td>
            <td>
                Сумма платежей:
            </td>
            <td>
                <b><?php $p = $model->payed + $model->to_pay;
                    echo $p; ?></b>
            </td>
        </tr>
    </table>
    <button class="btn btn-default" class="send_payments">Сохранить</button>
</div>