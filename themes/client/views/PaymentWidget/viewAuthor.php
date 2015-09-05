<div id="project_payments">
    <h3><?=ProjectModule::t('Payments')?></h3>
    <table class="table table-striped" style="font-size: 12px">
        <tr>
            <td>
                <?=ProjectModule::t('The cost of the order:')?>
            </td>
            <td>
                <?=ProjectModule::t('The amount to:')?>
            </td>
            <td>
                <?=ProjectModule::t('Received:')?>
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

