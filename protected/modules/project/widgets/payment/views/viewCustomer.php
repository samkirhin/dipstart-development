<div class="project_payments">
    <table class="table table-striped" style="font-size: 12px">
        <tr>
            <td>
                Стоимость заказа:
            </td>
            <td>
                Сумма на оплату:
            </td>
            <td>
                Оплачено:
            </td>
        </tr>
        <tr>
            <td>
                <b><?php echo $model->project_price; ?></b>
            </td>
            <td>
                <b><?php echo $model->to_receive; ?></b>
            </td>
            <td>
                <b><?php echo $model->approved_in; ?></b>
            </td>
        </tr>
    </table>
</div>

