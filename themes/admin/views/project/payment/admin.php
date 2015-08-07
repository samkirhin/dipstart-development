<script src="/js/bookkeeper.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/manager.css');?>
<div class="row white-block">
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
            <td class="payment-ya">
                {{if (details_ya == null || details_ya == '' || details_ya == 0) }}
                    Нет данных
                {{else}}
                    {{if approve == 0}}
                        <button class="btn btn-xs btn-default approve_payment" value="${id}"  pay_method="Ya.money">${details_ya}</button>
                    {{else}}
                        ${details_ya}
                    {{/if}}
                {{/if}}
            </td>
            <td class="payment-wm">
                {{if (details_wm == null || details_wm == '')}}
                    Нет данных
                {{else}}
                    {{if approve == 0}}
                        <button class="btn btn-xs btn-default approve_payment" value="${id}"  pay_method="WebMoney">${details_wm}</button>
                    {{else}}
                        ${details_wm}
                    {{/if}}
                {{/if}}
            </td>
            <td class="payment-bank">
                {{if (details_bank == null || details_bank == '')}}
                    Нет данных
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
                    Входящий
                {{else}}
                    Исходящий
                {{/if}}
            </td>
            <td class="payment-approve">
               {{if approve == 0}}
                    <button  class="btn btn-primary btn-xs approve_payment" value="${id}"  pay_method="Cash">Подтвердить</button>
                {{else}}
                    Подтвержден
                {{/if}}
            </td>
            <td>
                ${method}
            </td>
        </tr>
    </script>
    <script class="bookkeeperSummTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td colspan='4'>
                Найдено записей: ${ids_count}
            </td>
            
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                Сумма платежей:
            </td>
            <td>
                ${summary}
            </td>
            <td colspan='6'>
                
            </td>
            
        </tr>
    </script>
<h1>
    Бухгалтерия
</h1>
<span> <b>Фильтр</b> </span></br>
    
    <select class="search_field_select" >
        <option>Поле для поиска:</option>
        <option value="order_id">№ заказа</option>
        <option value="receive_date">Создан</option>
        <option value="pay_date">Оплачен</option>
        <option value="summ">Сумма</option>
        <option value="payment_type">Тип платежа</option>
        <option value="approve">Подтвержден</option>
        <option value="method">Создан</option>
    </select>
    
    <select class="search_type_select" >
        <option>Тип соответствия:</option>
        <option value="bigger">'<'</option>
        <option value="smaller">'>'</option>
        <option value="equal">'='</option>
    </select>

    <input type='text' class='search_string' placeholder="Значение" />

    <button class="btn btn-sm btn-default send_search"> Поиск </button>
    <button class="btn btn-sm btn-default clear_search"> Отменить поиск </button>
<table class="table table-striped table-bordered payment-table" style="font-size: 10px;">
    <thead>
        <th>
            <button class="searching" sort="id">ID</button>
        </th>
        <th>
            <button class="searching" sort="order_id">Заказ</button>
        </th>
        <th>
            <button class="searching" sort="receive_date">Создан</button>
        </th>
        <th>
            <button class="searching" sort="pay_date">Оплачен</button>
        </th>
        <th>
            <button class="searching" sort="theme">Тема</button>
        </th>
        <th>
            <button class="searching" sort="manager">Менеджер</button>
        </th>
        <th>
            <button class="searching" sort="user">Пользователь</button>
        </th>
        <th>
            <button class="searching" sort="summ">Сумма</button>
        </th>
        <th>
            <button class="searching" sort="details_ya">Я.Деньги</button>
        </th>
        <th>
            <button class="searching" sort="details_wm">WebMoney</button>
        </th>
        <th>
            <button class="searching" sort="details_bank">Банк</button>
        </th>
        <th>
            <button class="searching" sort="payment_type">Тип</button>
        </th>
        <th>
            <button class="searching" sort="approve">Подтвержден</button>
        </th>
        <th>
            <button class="searching" sort="method">Метод оплаты</button>
        </th>
    </thead>
    <tbody class="bookkeeperTable">
    </tbody>
</table>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var bookkeeperScript = new BookkeeperScript('/project/payment/apiView','receive_date');
    });
</script>
