<div>
	<label>Электронная почта: *</label>
	<input class="order_text_1" type="text" name='mail' value='<?php if (isset($_POST['mail'])) echo $_POST.['mail'];?>'/>
</div>
<div>
	<label>Контактное лицо: *</label>
	<input class="order_text_1" type="text" name='fio' value='<?php if (isset($_POST['fio'])) echo $_POST.['fio'];?>'/>
</div>
<div>
	<label>Сотовый телефон: *</label>
	<input class="order_text_1" type="text" name='mobila' value='<?php if (isset($_POST['mobila'])) echo $_POST.['mobila'];?>'/>
</div>
<input class="order_text_1" type="hidden" name='dom_mobila' value='<?php if (isset($_POST['dom_mobila'])) echo $_POST.['dom_mobila'];?>'/>
<input class="order_text_1" type="hidden"  name='rab_mobila' value='<?php if (isset($_POST['rab_mobila'])) echo $_POST.['rab_mobila'];?>'/>
<div>
	<label>ICQ: <?php if ($user_type=='avtor') echo '*';?></label>
	<input class="order_text_1" type="text"  name='icq' value='<?php if (isset($_POST['icq'])) echo $_POST.['icq'];?>'/>
</div>
<div>
	<label>Skype: <?php if ($user_type=='author') echo '*';?></label>
	<input class="order_text_1" type="text" name='skype' value='<?php if (isset($_POST['skype'])) echo $_POST.['skype'];?>'/>
</div>
<div>
	<label>Город: <?php if ($user_type=='author') echo '*';?></label>
	<input class="order_text_1" type="text" name='gorod' value='<?php if (isset($_POST['gorod'])) echo $_POST.['gorod'];?>'/>
</div>

<div>
    <label>Учебное заведение:</label>
    <input class="order_text_1" type="text" name='uz_zav' value='<?php if (isset($_POST['uz_zav'])) echo $_POST.['uz_zav'];?>'/>
</div>
<div>
    <label>Удобное время для связи:</label>
    <input class="order_text_1" type="text" name='udob_vrem' value='<?php if (isset($_POST['udob_vrem'])) echo $_POST.['udob_vrem'];?>'/>
</div>
<div>
    <label>Специальность:</label>
    <input class="order_text_1" type="text" name='spez' value='<?php if (isset($_POST['spez'])) echo $_POST.['spez'];?>'/>
</div>
<div>
    <label>Курс:</label>
    <input class="order_text_1" type="text" name='kurs' value='<?php if (isset($_POST['kurs'])) echo $_POST.['kurs'];?>'/>
</div>
<div>
    <label>Откуда Вы узнали о нас:</label>
    <input class="order_text_1" id="hastip" type="text" name='o_nas' value='<?php if (isset($_POST['o_nas'])) echo $_POST.['o_nas'];?>'/>
</div>
