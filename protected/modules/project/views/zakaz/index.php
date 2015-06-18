<?php
/*<script src="/js/bookkeeper.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<div id="bookkeeperView">
<script class="bookkeeperTableTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td>
                <a href="index.php?r=project/zakaz/update&id=${id}">${id}</a>
            </td>
            <td>
                ${title}
            </td>
            <td>
                ${job_name}
            </td>
            <td>
                ${cat_name}
            </td>
            <td>
                ${date}
            </td>
            <td>
                ${manager_informed}
            </td>
            <td>
                ${date_finish}
            </td>
        </tr>
    </script>
<?php
/* @var $this ZakazController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	ProjectModule::t('Zakazs'),
);

/*
    <script class="bookkeeperSummTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td colspan='4'>
                Найдено записей: ${ids_count}
            </td>
         </tr>
    </script>

<h1><?=ProjectModule::t('Zakazs')?></h1>
<span> <b>Фильтр</b> </span><br>

    <select class="search_field_select" >
        <option>Поле для поиска:</option>
        <option value="id">№ заказа</option>
        <option value="title">Название</option>
        <option value="job_name.jobs.job_id">Тип</option>
        <option value="cat_name.categories.category_id">Категория</option>
        <option value="date">Создан</option>
        <option value="manager_informed">Дата информирования менеджера</option>
        <option value="date_finish">Срок</option>
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
            <button class="searching" sort="title">Название</button>
        </th>
        <th>
            <button class="searching" sort="job_id">Тип</button>
        </th>
        <th>
            <button class="searching" sort="cat_id">Категория</button>
        </th>
        <th>
            <button class="searching" sort="date">Создан</button>
        </th>
        <th>
            <button class="searching" sort="manager_informed">Дата информирования менеджера</button>
        </th>
        <th>
            <button class="searching" sort="date_finish">Срок</button>
        </th>
    </thead>
    <tbody class="bookkeeperTable">
    </tbody>
</table>
</div>
*/?>
<div id="grid">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'title',
        'jobName',
        'catName',
        'dateCreation',
        'managerInformed',
        'dateFinish',
    ),
    'ajaxType'=>'POST',
    'ajaxUpdate'=>'grid',
));
?>
</div>
<?php /*
<script type="text/javascript">
    $(document).ready(function () {
        var bookkeeperScript = new BookkeeperScript('index.php?r=project/zakaz/apiView','date');
    });
</script>
*/