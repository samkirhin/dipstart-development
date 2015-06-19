
<div>
	<label>Учебная дисциплина:</label>
	<select name="dicip" id="hastip" title="нажмите на стрелочку в конце строки, чтобы выбрать учебную дисциплину ">
        <?php
        $model=Categories::model()->findAll();
        foreach ($model as $type)
            echo '<option value="'.$type->id.'">'.$type->cat_name.'</option>';
        ?>
    </select>
</div>
<div>
	<label>Вид работы:</label>
	<select name="vid_rabota" id="hastip" title="нажмите на стрелочку в конце строки, чтобы выбрать вид работы">
        <?php
        $model=Jobs::model()->findAll();
        foreach ($model as $type)
            echo '<option value="'.$type->id.'">'.$type->job_name.'</option>';
        ?>
    </select>
</div>
<div>
	<label>Тема работы: *</label>
	<input name="tema" id="hastip" title="если Вы еще не выбрали тему работы, напишите “тема не выбрана” " type="text" value="<?php if (isset($_POST['tema'])) echo $_POST.['tema'];?>"/>
</div>
<div>
	<label>Содержание работы:</label>
	<textarea id="hastip" title="напишите план работы, содержание или пожелания к содержанию" rows="5" cols="50" name="soder" ><?php if (isset($_POST['soder'])) echo $_POST.['soder'];?></textarea>
</div>
<div>
	<label>Примерное количество страниц:</label>
	<input class="order_text_1" id="hastip" title="сколько должно быть страниц в Вашей работе? " type="text" name='straniz' value='<?php if (isset($_POST['straniz'])) echo $_POST.['straniz'];?>'/>
</div>
<div>
	<label>Срок выполнения:</label>
	<input class="order_text_1 hastip" title="укажите дату, когда Вы хотите получить готовую работу. Для этого воспользуйтесь календарем в конце строки."  id="data1" type="text" style="width: 75px; margin-right: 10px;"  name="datavip" maxlength="0" value='<?php if (isset($_POST['datavip'])) echo $_POST.['datavip'];?>'/>
</div>
<div>
	<label>Дата защиты:</label>
	<input class="order_text_1 hastip" title="укажите реальную дату, когда Вы будете защищать свою работу. Для этого воспользуйтесь календарем в конце строки."  type="text" style="width: 75px; margin-right: 10px;"  id="data2" name="dataeror" maxlength="0" value='<?php if (isset($_POST['dataeror'])) echo $_POST.['dataeror'];?>'/>
</div>
<div>
	<label>Примечание к заявке:</label>
	<textarea class="order_textarea" rows="5"  name="prim" ><?php if (isset($_POST['prim'])) echo $_POST.['prim'];?></textarea>
</div>
<div>
    <label>Дополнения:</label>
	<input name="file[]" type="file" id="hastip" title="для того, чтобы прикрепить файлы (методические указания), кликните по ссылке “Прикрепить файл” и нажмите “обзор...”">
    <?php if (isset($_POST['dop_zakaz'])) echo $_POST.['dop_zakaz'];?>
</div>
<?php if (isset($_POST['dop_zakaz'])): ?>
	<div>
		<label>Оценить стоимость заказа:</label>
		<input class="order_text_1" type='checkbox' name='re_zakaz' <?php if (isset($_POST['dop_zakaz'])) echo 'checked';?>/>
	</div>
	<div>
		<label>Доработки:</label>
		<input class="order_text_1" type='checkbox' name='krit' <?php if (isset($_POST['krit'])) echo 'checked';?>/>
	</div>
<?php endif; ?>