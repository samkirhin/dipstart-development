<div id="project_payments">
    <h3><?=ProjectModule::t('Payments')?></h3>
    <table class="table table-striped" style="font-size: 12px;table-layout: fixed;">
        <tr>
            <td>
                <?=ProjectModule::t('The cost of the order:')?>
            </td>
            <td>
                <?=ProjectModule::t('Amount to pay:')?>
            </td>
            <td>
                <?=ProjectModule::t('Paid:')?>
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

