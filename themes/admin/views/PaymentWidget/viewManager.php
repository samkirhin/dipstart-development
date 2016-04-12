
<div id="project_payments" class="col-xs-12">

    <h4><?=ProjectModule::t('Payments')?></h4>
    <table class="table table-striped paytable">
       <tr>
            <td>
                <?=ProjectModule::t('Project cost:')?>
                <?php if ($this->hints['Zakaz_project_cost']) { ?>
                <div class="hint-block __project_cost">
                    ?
                    <div class="hint-block_content">
                        <?=$this->hints['Zakaz_project_cost']?>
                    </div>
                </div>
                <?php } ?>
            </td>
            <td>
                <input type="text" class="project_price_input" size="10" value="<?php echo $model->project_price; ?>"/>
            </td>
            
        </tr>
        <tr>
            <td>
                <?=ProjectModule::t('Obtained from the client:')?>
                <?php if ($this->hints['Zakaz_payment_received']) { ?>
                <div class="hint-block __payment_received">
                    ?
                    <div class="hint-block_content">
                        <?=$this->hints['Zakaz_payment_received']?>
                    </div>
                </div>
                <?php } ?>
            </td>
            <td>
                <b><span class="payment_received"><?php echo $model->received; ?></span></b>
            </td>
        </tr>
        <tr>
            <td>
                <?=ProjectModule::t('To draw up the account:')?>
                <?php if ($this->hints['Zakaz_to_receive']) { ?>
                <div class="hint-block __to_receive">
                    ?
                    <div class="hint-block_content">
                        <?=$this->hints['Zakaz_to_receive']?>
                    </div>
                </div>
                <?php } ?>
            </td>
            <td>
                <input type="text" size="10" class="to_receive_input" value=""/>
            </td>
        </tr>
        <tr>
            <td>
                <?=ProjectModule::t('It is worth to pay:')?>
                <?php if ($this->hints['Zakaz_payment_to_receive']) { ?>
                <div class="hint-block __payment_to_receive">
                    ?
                    <div class="hint-block_content">
                        <?=$this->hints['Zakaz_payment_to_receive']?>
                    </div>
                </div>
                <?php } ?>
            </td>
            <td>
                <b><span class="payment_to_receive"><?php echo $model->to_receive; ?></span></b>
            </td>
        </tr>
    </table>
    <table class="table table-striped paytable">
       <tr>
            <td>
                <?=ProjectModule::t('The cost for the author:')?>
                <?php if ($this->hints['Zakaz_work_price']) { ?>
                <div class="hint-block __work_price">
                    ?
                    <div class="hint-block_content">
                        <?=$this->hints['Zakaz_work_price']?>
                    </div>
                </div>
                <?php } ?>
            </td>
            <td>
                <input type="text" class="work_price_input" size="10" value="<?php echo $model->work_price; ?>"/>
            </td>
        </tr>
        <tr>
            <td>
                <?=ProjectModule::t('Paid work:')?>
                <?php if ($this->hints['Zakaz_payment_payed']) { ?>
                <div class="hint-block __payment_payed">
                    ?
                    <div class="hint-block_content">
                        <?=$this->hints['Zakaz_payment_payed']?>
                    </div>
                </div>
                <?php } ?>
            </td>
            <td>
                <b><span class="payment_payed"><?php echo $model->payed; ?></span></b>
            </td>
            </td>
        </tr>
        <tr>
            <td>
                <?=ProjectModule::t('Send payment to:')?>
                <?php if ($this->hints['Zakaz_to_pay']) { ?>
                <div class="hint-block __to_pay">
                    ?
                    <div class="hint-block_content">
                        <?=$this->hints['Zakaz_to_pay']?>
                    </div>
                </div>
                <?php } ?>
            </td>
            <td>
                <input type="text" size="10" class="to_pay_input" value="" <?php if($model->received=='') echo 'disabled';?>/>
            </td>
        </tr>
        <tr>
            <td>
                <?=ProjectModule::t('Total to pay:')?>
                <?php if ($this->hints['Zakaz_payment_to_pay']) { ?>
                <div class="hint-block __payment_to_pay">
                    ?
                    <div class="hint-block_content">
                        <?=$this->hints['Zakaz_payment_to_pay']?>
                    </div>
                </div>
                <?php } ?>
            </td>
            <td>
                <b><span class="payment_to_pay"><?php echo $model->to_pay; ?></span></b>
            </td>
        </tr>
    </td>
    </table>
	<? //if($model->to_receive>0){ ?>
	<div class="confirm-the-payment">
		<span><?=ProjectModule::t('Confirm payment from client:')?></span>
		<div class="btn-group-xs" role="group">
		<button class="btn btn-default send_managers_approve"><?=ProjectModule::t('Confirm')?></button>
        <?php if ($this->hints['Zakaz_confirm']) { ?>
        <div class="hint-block __confirm">
            ?
            <div class="hint-block_content">
                <?=$this->hints['Zakaz_confirm']?>
            </div>
        </div>
        <?php } ?>
		<button class="btn btn-default send_managers_cancel"><?=ProjectModule::t('Cancel')?></button>
        <?php if ($this->hints['Zakaz_cancel']) { ?>
        <div class="hint-block __cancel">
            ?
            <div class="hint-block_content">
                <?=$this->hints['Zakaz_cancel']?>
            </div>
        </div>
        <?php } ?>
		<?php 
        
            if ($zakaz) {
                $i = 1;
                foreach ($zakaz->images as $item) {
                    echo CHtml::link(ProjectModule::t('Cheque') . $i++, PaymentImage::getFolder() . $item->image, array ('target' => '_blank' )) . ' ';
                }
            }
		?>
		</div>
	</div>
	<? //} ?>
	<?php $disable = ''; ?>
	<?php if(Yii::app()->user->isGuest) $disabled = ' disabled;' ?>
	
    <button class="btn btn-primary pay-save-btn send_user_payments"<?= $diabled ?>><?=ProjectModule::t('Save')?></button>
    </div>

<script type="text/javascript">
    $(document).ready(function () {
        var projectPayments = new ProjectPayments(<?php echo $projectId; ?>);
    });
</script>