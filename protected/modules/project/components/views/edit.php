<script src="/js/zakaz_parts.js"></script>
<script src="/js/jquery.tmpl.min.js"></script>
<div id="zakaz_parts">
    <!-- Тэмплэйт для редактирования части -->
    <script class="editPartTemplate" type="text/x-jquery-tmpl">
        <table style="background-color:lightgrey; font-size: 14px">
            <tr>
                <td width="25px">
                    id:
                </td>
                <td width="200px">
                    <b>${id}</b>
                </td>
            </tr>
            <tr>
                <td>
                    id проекта:
                </td>
                <td>
                    <b>${proj_id}</b>
                </td>
            </tr>
            <tr>
                <td>
                    Название:
                </td>
                <td>
                    <input type="text" class="edit_part_title" value="${title}">
                </td>
            </tr>
            <tr>
                <td>
                    Дата:
                </td>
                <td>
                    <input type="text" class="edit_part_name" value="${date}">
                </td>
            </tr>
            <tr>
                <td>
                    Файл:
                </td>
                <td>
                    <input type="file" class="edit_part_name" value="${file}">
                </td>
            </tr>
            <tr>
                <td>
                    Отображение:
                </td>
                <td>
                    <input type="text" class="edit_part_name" value="${show}">
                </td>
            </tr>
            <tr>
                <td>
                    Автор:
                </td>
                <td>
                    <b>${author_id}</b>
                </td>
            </tr>
            <tr>
                <td>
                    Комментарий:
                </td>
                <td>
                    <input type="text" class="edit_part_name" value="${comment}">
                </td>
            </tr>
            <tr>
                <td>
                    <button class="save_changes">Сохранить</button>
                </td>
                <td>
                    <button class="cancel">Отмена</button>
                </td>
            </tr>
        </table>
    </script>
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