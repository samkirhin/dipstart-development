<script src="/js/bookkeeper.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<div id="bookkeeperView">
<script class="bookkeeperTableTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td>
                ${id}
            </td>
            <td>
                ${order_id}
            </td>
            <td>
                ${receive_date}
            </td>
            <td>
                ${pay_date}
            </td>
            <td>
                ${theme}
            </td>
            <td>
                ${manager}
            </td>
            <td>
                ${user}
            </td>
            <td>
                ${summ}
            </td>
            <td>
                {{if details_ya == null}}
                    ProjectModule::t('No data')
                {{else}}
                    {{if approve == 0}}
                        <button class="btn btn-xs btn-default approve_payment" value="${id}"  pay_method="Ya.money">${details_ya}</button>
                    {{else}}
                        ${details_ya}
                    {{/if}}
                {{/if}}
            </td>
            <td>
                {{if details_wm == null}}
                    ProjectModule::t('No data')
                {{else}}
                    {{if approve == 0}}
                        <button class="btn btn-xs btn-default approve_payment" value="${id}"  pay_method="WebMoney">${details_wm}</button>
                    {{else}}
                        ${details_wm}
                    {{/if}}
                {{/if}}
            </td>
            <td>
                {{if details_bank == null}}
                    ProjectModule::t('No data')
                {{else}}
                    {{if approve == 0}}
                        <button class="btn btn-xs btn-default approve_payment" value="${id}"  pay_method="Bank">${details_bank}</button>
                    {{else}}
                        ${details_bank}
                    {{/if}}
                {{/if}}
            </td>
            <td>
                {{if payment_type == 0}}
                    ProjectModule::t('Incomming')
                {{else}}
                    ProjectModule::t('Outgouing')
                {{/if}}
            </td>
            <td>
               {{if approve == 0}}
                    <button  class="btn btn-primary btn-xs approve_payment" value="${id}"  pay_method="Cash"><?= ProjectModule::t('Confirm') ?></button>
                {{else}}
                    ProjectModule::t('Confirmed')
                {{/if}}
            </td>
            <td>
			{{
                s = ${method}
				ProjectModule::t(s)
			}}
            </td>
        </tr>
    </script>
    <script class="bookkeeperSummTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td colspan='4'>
                ProjectModule::t('Records found'): ${ids_count}
            </td>
            
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                <?= ProjectModule::t('The amount of payments') ?>:
            </td>
            <td>
                ${summary}
            </td>
            <td colspan='6'>
                
            </td>
            
        </tr>
    </script>
<h1>
    <?= ProjectModule::t('Accounts department') ?>
</h1>
<span> <b><?= ProjectModule::t('Filter') ?></b> </span></br>
    
    <select class="search_field_select" >
        <option><?= ProjectModule::t('Field For Search').':' ?></option>
        <option value="order_id"><?= ProjectModule::t('Order Num') ?></option>
        <option value="receive_date"><?= ProjectModule::t('Created') ?></option>
        <option value="pay_date"><?= ProjectModule::t('Payed') ?><?= ProjectModule::t('Payed') ?></option>
        <option value="summ">"<?= ProjectModule::t('Sum') ?></option>
        <option value="payment_type"><?= ProjectModule::t('Payment Type') ?></option>
        <option value="approve"><?= ProjectModule::t('Confirmed') ?></option>
        <option value="method"><?= ProjectModule::t('Created') ?></option>
    </select>
    
    <select class="search_type_select" >
	    <option><?= ProjectModule::t('Match Type').':' ?></option>
        <option value="bigger">'<'</option>
        <option value="smaller">'>'</option>
        <option value="equal">'='</option>
    </select>

    <input type='text' class='search_string' placeholder="<?= ProjectModule::t('Value') ?>" />

    <button class="btn btn-sm btn-default send_search"> <?= ProjectModule::t('Search'> ?> </button>
    <button class="btn btn-sm btn-default clear_search"> <?= ProjectModule::t('Cancel search') ?> </button>
<table class="table table-striped table-bordered" style="font-size: 10px;">
    <thead>
        <th>
            <button class="searching" sort="id">ID</button>
        </th>
        <th>
            <button class="searching" sort="order_id"><?= ProjectModule::t('Order') ?></button>
        </th>
        <th>
            <button class="searching" sort="receive_date"><?= ProjectModule::t('Created') ?></button>
        </th>
        <th>
            <button class="searching" sort="pay_date"><?= ProjectModule::t('Payed') ?></button>
        </th>
        <th>
            <button class="searching" sort="theme"><?= ProjectModule::t('Topic') ?></button>
        </th>
        <th>
            <button class="searching" sort="manager"><?= ProjectModule::t('Manager') ?></button>
        </th>
        <th>
            <button class="searching" sort="user"><?= ProjectModule::t('_User') ?></button>
        </th>
        <th>
            <button class="searching" sort="summ"><?= ProjectModule::t('Sum') ?></button>
        </th>
        <th>
            <button class="searching" sort="details_ya"><?= ProjectModule::t('Yandeх.Money') ?></button>
        </th>
        <th>
            <button class="searching" sort="details_wm"><?= ProjectModule::t('WebMoney') ?></button>
        </th>
        <th>
            <button class="searching" sort="details_bank"><?= ProjectModule::t('Bank') ?></button>
        </th>
        <th>
            <button class="searching" sort="payment_type"><?= ProjectModule::t('Type') ?></button>
        </th>
        <th>
            <button class="searching" sort="approve"><?= ProjectModule::t('Confirmed') ?></button>
        </th>
        <th>
            <button class="searching" sort="method"><?= ProjectModule::t('Method of payment') ?></button>
        </th>
    </thead>
    <tbody class="bookkeeperTable">
    </tbody>
</table>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var bookkeeperScript = new BookkeeperScript('index.php?r=project/payment/apiView','receive_date');
    });
</script>
