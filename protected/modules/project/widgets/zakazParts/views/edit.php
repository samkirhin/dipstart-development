<script src="/js/zakaz_parts.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<div id="zakaz_parts">
    <!-- Тэмплэйт для отображения частей -->
    <script class="zakazPartTemplate" type="text/x-jquery-tmpl">
        <table style="background-color:lightgrey; font-size: 14px" >
        <tr>
            <td width="100px">
                id: '${id}'
            </td>
            <td width="100px">
                date: '${date}'
            </td>
            <td width="100px">
                title: '${title}'
            </td>
        </tr>
        <tr>
            <td>
                file: '${file}'
            </td>
            <td>
                comment: '${comment}'
            </td>
            <td>
                author: '${author_id}'
            </td>
        </tr>
        <tr>
            <td>
                <button class='edit' type='submit' value='${id}'>Edit</button>
            </td>
            <td>
                <button class='delete' value='${id}'>Delete</button>
            </td>
            <td>
            </td>
        </tr>
        </table>
    </script>
    <h4>Части</h4>
    <button class="add">Add</button>
    <div class="form">

<form id="zakaz-parts-form" action="/index.php?r=project/zakazParts/apiGetPart" method="post">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	        
	<div class="row">
		<label for="ZakazParts_proj_id" class="required">ID Проекта <span class="required">*</span></label>		1	</div>

	<div class="row">
		<label for="ZakazParts_title" class="required">Название <span class="required">*</span></label>		<input size="60" maxlength="255" name="ZakazParts[title]" id="ZakazParts_title" type="text" value="ergfsdgs" />			</div>

	<div class="row">
		<label for="ZakazParts_comment">Комментарий</label>		<textarea rows="6" cols="50" name="ZakazParts[comment]" id="ZakazParts_comment"></textarea>			</div>

	<div class="row">
		<label for="ZakazParts_file">Файл</label>		<div id="EAjaxUpload"><noscript><p>Please enable JavaScript to use file uploader.</p></noscript></div>                <input name="ZakazParts[file]" id="ZakazParts_file" type="hidden" />			</div>

	<div class="row">
		<label for="ZakazParts_date">Дата</label>                <input style="height:20px;background-white:blue;color:black;" id="Zakaz_date" type="text" value="0000-00-00" name="Zakaz[date]" />	</div>

	<div class="row">
		<label for="ZakazParts_author_id">Автор</label>		<input name="ZakazParts[author_id]" id="ZakazParts_author_id" type="text" value="0" />			</div>

	<div class="row">
		<label for="ZakazParts_show">Отображение</label>		<input name="ZakazParts[show]" id="ZakazParts_show" type="text" value="0" />			</div>

	<div class="row buttons">
		<input type="submit" name="yt0" value="Save" />	</div>

</form>
    <!-- Див для отображения списка частей -->
    <div class="show_parts">
        
    </div>
    <!-- Див для создания части -->
    <div class="add_part">
        <input class="create_part_name" type="text" name="part_title" value=""/> Название</br>
        <button class="create_part">Добавить</button>&nbsp;<button class="cancel">Отмена</button>
    </div>
    <!-- Див для редактирования части -->
    <div class="edit_part">
        Edit part <button class="cancel">Отмена</button>
    </div>
</div>
<!-- Вызов скрипта для обраьртки вьюхи -->
<script type="text/javascript">
    $(document).ready(function () {
        var zakazPartsView = new ZakazPartsView(
            <?php echo $orderId;?>
        );
    });
</script>