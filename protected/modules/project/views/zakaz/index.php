<script src="/js/bookkeeper.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<div id="bookkeeperView">
<script class="bookkeeperTableTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td>
                <a href="index.php?r=project/zakaz/update&id=${id}">${id}</a>
            </td>
            <td>
                ${username}
            </td>
            <td>
                ${cat_name}
            </td>
            <td>
                ${job_name}
            </td>
            <td>
                ${title}
            </td>
            <td>
                ${date}
            </td>
            <td>
                ${max_exec_date}
            </td>
            <td>
                ${status}
            </td>
        </tr>
    </script>
<?php
/* @var $this ZakazController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);

?>
    <script class="bookkeeperSummTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td colspan='4'>
                Найдено записей: ${ids_count}
            </td>
         </tr>
    </script>

<h1><?=ProjectModule::t('Zakazs')?></h1>
<span> <b>Фильтр</b> </span></br>

    <select class="search_field_select" >
        <option>Поле для поиска:</option>
        <option value="id">№ заказа</option>
        <option value="username.user.user_id">Заказчик</option>
        <option value="cat_name.categories.category_id">Категория</option>
        <option value="job_name.jobs.job_id">Тип</option>
        <option value="title">Название</option>
        <option value="date">Создан</option>
        <option value="max_exec_date">Срок до</option>
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
<table class="table table-bordered">
    <thead>
        <th>
            <button class="searching" sort="id">id</button>
        </th>
        <th>
            <button class="searching" sort="user_id">Заказчик</button>
        </th>
        <th>
            <button class="searching" sort="category_id">Категория</button>
        </th>
        <th>
            <button class="searching" sort="job_id">Тип</button>
        </th>
        <th>
            <button class="searching" sort="title">Название</button>
        </th>
        <th>
            <button class="searching" sort="date">Создан</button>
        </th>
        <th>
            <button class="searching" sort="max_exec_date">Срок до</button>
        </th>
        <th>
            <button class="searching" sort="status">Статус</button>
        </th>

    </thead>
    <tbody class="bookkeeperTable">
    </tbody>
<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ ?>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        var bookkeeperScript = new BookkeeperScript('index.php?r=project/zakaz/apiView','date');
    });
</script>
