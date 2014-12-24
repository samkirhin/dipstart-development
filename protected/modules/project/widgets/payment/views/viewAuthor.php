<div id="project_payments">
    <table class="table table-striped" style="font-size: 12px">
        <tr>
            <td>
                Стоимость заказа:
            </td>
            <td>
                Сумма на получение:
            </td>
            <td>
                Получено:
            </td>
        </tr>
        <tr>
            <td>
                <b><?php echo $model->work_price; ?></b>
            </td>
            <td>
                <b><?php echo $model->to_pay; ?></b>
            </td>
            <td>
                <b><?php echo $model->approved_out; ?></b>
            </td>
        </tr>
    </table>
</div>

