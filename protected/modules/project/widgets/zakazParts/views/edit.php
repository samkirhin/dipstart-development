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