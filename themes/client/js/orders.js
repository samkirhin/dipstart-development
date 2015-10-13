	$(document).ready(function()
	{
		$('body').on('dblclick', '#zakaz-grid tbody tr', function(event)
		{
			var
				rowNum = $(this).index(),
				keys = $('#zakaz-grid > div.keys > span'),
				rowId = keys.eq(rowNum).text();

			location.href = '/project/chat?orderId=' + rowId;
		});
	});
	$(document).ready(function()
	{
		$('body').on('dblclick', '#zakaz-grid-done tbody tr', function(event)
		{
			var
				rowNum = $(this).index(),
				keys = $('#zakaz-grid-done > div.keys > span'),
				rowId = keys.eq(rowNum).text();

			location.href = '/project/chat?orderId=' + rowId;
		});
	});

	function clickOnTab(num){
		if (num == 0){
			document.getElementById('first-tab').style.display = 'block';
			document.getElementById('second-tab').style.display = 'none';

			document.getElementById('first-tab').style.backgroundColor = '#FFFFFF';
			document.getElementById('second-tab').style.backgroundColor = '#EBF4FF';
			$('#first-tab-li').addClass('active');
			$('#second-tab-li').removeClass('active');
		} else {
			document.getElementById('first-tab').style.display = 'none';
			document.getElementById('second-tab').style.display = 'block';

			document.getElementById('first-tab').style.backgroundColor = '#FFFFFF';
			document.getElementById('second-tab').style.backgroundColor = '#EBF4FF';
			$('#first-tab-li').removeClass('active');
			$('#second-tab-li').addClass('active');
		};	
	};	
