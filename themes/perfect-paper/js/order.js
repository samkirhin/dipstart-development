var ORDER_FORM_ID = "#_order_form";
var ELEMENT_CLASS = ".block_element";

$(document).ready(function() { 
    
    
    if(10 == 10) {
        $('.btn-procced').click(function () {
        window.GIHhtQfW_AtmUrls = window.GIHhtQfW_AtmUrls || [];
        window.GIHhtQfW_AtmUrls.push('/ph_proceed/');
    });

    $('.ab3_test_nothx').click(function () {
        window.GIHhtQfW_AtmUrls = window.GIHhtQfW_AtmUrls || [];
        window.GIHhtQfW_AtmUrls.push('/ph_final_order_placed/');
    });

    $('.ab3_test_upgr').click(function () {
        window.GIHhtQfW_AtmUrls = window.GIHhtQfW_AtmUrls || [];
        window.GIHhtQfW_AtmUrls.push('/ph_final_order_placed/');
    });
    }


	if(10 == 17) { $('#footer .direct-call-btn').remove(); }
	var decrPages = function(e){
		pages = $(e.target).closest("div").find("._pages");
		value = pages.attr("value")*1;
		if(value>0) {
			pages.attr("value", value-1); }
		$(ORDER_FORM_ID).find("[name='pages']").trigger('change');
		$(ORDER_FORM_ID).find("[name='pages']").trigger('focusout');
		countWords();
	}

	var incrPages = function(e){
		pages = $(e.target).closest("div").find("._pages");
		new_value = pages.attr("value")*1+1;
		if(new_value.toString().length <= pages.attr("maxlength"))
		{pages.attr("value", new_value);}
		$(ORDER_FORM_ID).find("[name='pages']").trigger('change');
		$(ORDER_FORM_ID).find("[name='pages']").trigger('focusout');
		countWords();
	}

	$("._pages_decr").click(decrPages)
	$("._pages_incr").click(incrPages)
	$("._pages").keydown(function(event){
		switch(event.keyCode ? event.keyCode : event.which){
			case(38):
				incrPages(event);
				break;
			case(40):
				decrPages(event);
				break;
		}
	})

	var decrSlides = function(e){
		slides = $(e.target).closest("div").find("._slides");
		value_slides = slides.attr("value")*1;
		if(value_slides>0)
		{slides.attr("value", value_slides-1);}
		$(ORDER_FORM_ID).find("[name='slides']").trigger('change');
		$(ORDER_FORM_ID).find("[name='slides']").trigger('focusout');
		countPrice();
	}

	var incrSlides = function(e){
		slides = $(e.target).closest("div").find("._slides");
		new_value_slides = slides.attr("value")*1+1;
		if(new_value_slides.toString().length <= slides.attr("maxlength"))
		{slides.attr("value", new_value_slides);}
		$(ORDER_FORM_ID).find("[name='slides']").trigger('change');
		$(ORDER_FORM_ID).find("[name='slides']").trigger('focusout');
		countPrice();
	}

	$("._slides_decr").click(decrSlides)
	$("._slides_incr").click(incrSlides)
	$("._slides").keydown(function(event){
		switch(event.keyCode ? event.keyCode : event.which){
			case(38):
				incrSlides(event);
				break;
			case(40):
				decrSlides(event);
				break;
		}
	})

	var decrSources_needed = function(e){
		sources = $(e.target).closest("div").find("._sources_needed");
		value_sources = sources.attr("value")*1;
		if(value_sources>0)
			sources.attr("value", value_sources-1);
		countPrice();
	}

	var incrSources_needed = function(e){
		sources = $(e.target).closest("div").find("._sources_needed");
		new_value_sources = sources.attr("value")*1+1;
		if(new_value_sources.toString().length <= sources.attr("maxlength"))
			sources.attr("value", new_value_sources);
		countPrice();
	}

	$("._sources_needed_decr").click(decrSources_needed)
	$("._sources_needed_incr").click(incrSources_needed)
	$("._sources_needed").keydown(function(event){
		switch(event.keyCode ? event.keyCode : event.which){
			case(38):
				incrSources_needed(event);
				break;
			case(40):
				decrSources_needed(event);
				break;
		}
	})

	var decrQuestions = function(e){
		questions = $(e.target).closest("div").find("._questions");
		value_questions = questions.attr("value")*1;
		if(value_questions>0)
			questions.attr("value", value_questions-1);
		$(ORDER_FORM_ID).find("[name='questions']").trigger('change');
		$(ORDER_FORM_ID).find("[name='questions']").trigger('focusout');
		countPrice();
	}

	var incrQuestions = function(e){
		questions = $(e.target).closest("div").find("._questions");
		new_value_questions = questions.attr("value")*1+1;
		if(new_value_questions.toString().length <= questions.attr("maxlength"))
			questions.attr("value", new_value_questions);
		$(ORDER_FORM_ID).find("[name='questions']").trigger('change');
		$(ORDER_FORM_ID).find("[name='questions']").trigger('focusout');
		countPrice();
	}

	$("._questions_decr").click(decrQuestions)
	$("._questions_incr").click(incrQuestions)
	$("._questions").keydown(function(event){
		switch(event.keyCode ? event.keyCode : event.which){
			case(38):
				incrQuestions(event);
				break;
			case(40):
				decrQuestions(event);
				break;
		}
	})

	var decrProblems = function(e){
		problems = $(e.target).closest("div").find("._problems");
		value_problems = problems.attr("value")*1;
		if(value_problems>0) {
			problems.attr("value", value_problems-1); }
		$(ORDER_FORM_ID).find("[name='problems']").trigger('change');
		$(ORDER_FORM_ID).find("[name='problems']").trigger('focusout');
		countPrice();
	}

	var incrProblems = function(e){
		problems = $(e.target).closest("div").find("._problems");
		new_value_problems = problems.attr("value")*1+1;
		if(new_value_problems.toString().length <= problems.attr("maxlength"))
		{problems.attr("value", new_value_problems);}
		$(ORDER_FORM_ID).find("[name='problems']").trigger('change');
		$(ORDER_FORM_ID).find("[name='problems']").trigger('focusout');
		countPrice();
	}

	$("._problems_decr").click(decrProblems)
	$("._problems_incr").click(incrProblems)
	$("._problems").keydown(function(event){
		switch(event.keyCode ? event.keyCode : event.which){
			case(38):
				incrProblems(event);
				break;
			case(40):
				decrProblems(event);
				break;
		}
	})

	$('.discount-block-hide').hide();  		
	$('#have_disc').click(function(){ 	
		$('.discount-block-hide').show();  		
	});

	$("[name='confirm_email'], [name='confirm_password']").bind('cut copy paste', function(event) {
		event.preventDefault();
	});

	$.getScript("/public/js/_order_form.js");

	//merge validation config order + client create
	$.getJSON(FORM_VALIDATOR_CONFIGS_DIR + ('_order_form.json'),
	function(idata) {
		config = idata;
		$.getJSON(FORM_VALIDATOR_CONFIGS_DIR + ('create_client.json'),
		function(idata) {
			config = $.extend({}, config, idata);
			FORM_VALIDATE_CONFIGS['_order_form'] = config;
			bindValidate($(ORDER_FORM_ID), '_order_form');
		}
	);
	}
);

	//client authorization
	$(ORDER_FORM_ID).find("[name='user']").change(function() {
		if ($(this).val() == 1) {
			$(ORDER_FORM_ID).find("#_create_client").show();
			$(ORDER_FORM_ID).find("#_client_login").hide();
		} else {
			$(ORDER_FORM_ID).find("#_client_login").show();
			$(ORDER_FORM_ID).find("#_create_client").hide();
		}
		dragTotal();
	})

	$(ORDER_FORM_ID).find("#order_contact_block li a").click(function() {
		if (($(ORDER_FORM_ID).find("#user_input").val() == "1")) {
			$(ORDER_FORM_ID).find(".signed_up_class").show();
		}else{
			$(ORDER_FORM_ID).find(".signed_up_class").hide();
		}
	});

	//set client timezone
	$(ORDER_FORM_ID).find("input[name='timezone']").val(new Date().getTimezoneOffset() / 60 * -1);

	//client registration coutry change
	$(ORDER_FORM_ID).find("select[name='country']").change(function() {
		$("#phone_prefix").val($(this).find("option:selected").attr("phone_prefix"));
	})

	if($(ORDER_FORM_ID).find("[name='lead']").length>0){
		$(ORDER_FORM_ID).find("select[name='country'] option[phone_prefix='"+$("#phone_prefix").val()+"']").attr('selected','selected');
	}
	//submit
	function authHiddenFormSubmit(form, order_id, bid, token) {
		if(10 == 4) { custome_ga('send', 'event', 'proceedtopayment_a', 'submit', 'variant_a');}		
		if (($(ORDER_FORM_ID).find("#user_input").val() == "2")) {
			var email = form.find('input[name="email_reg"]').val();
			var pass = form.find('input[name="password_reg"]').val();
		} else {
			var email = form.find('input[name="email"]').val();
			var pass = form.find('input[name="password"]').val();
		}

		if (1) {
			ga('send', 'event', 'proceedtopayment', 'submit', 'payment');
			window._fbq = window._fbq || []; 
			_fbq.push(['track', 6023082909321, {currency: 'HUF', value: 1.00}]);
		}	
		
		$('#hidden_auth_form input[name="email"]').val(email);
		$('#hidden_auth_form input[name="pass"]').val(pass);
		$('#hidden_auth_form input[name="bid"]').val(bid);
		$('#hidden_auth_form input[name="token"]').val(token);
		$('#hidden_auth_form').submit();
	}

	var submitted = false;
	var attr_form =$('#hidden_auth_form').attr('action');

	$('.modal-content button.go_to_step2').click(function(){           
		if($(this).hasClass('ab1_test_upgr')){
			$(ORDER_FORM_ID).find('[name="academic_level"][value="1003"]').click();
			if (10 == 4) {ga('send', 'event', 'upgrade', 'click', 'undergraduatepopup');  }
			//if (10 == 6) { _gaq.push(['_trackEvent', 'upgrade', 'click', 'undergraduatepopup']); }
		}else if($(this).hasClass('ab2_test_upgr')){
			$(ORDER_FORM_ID).find('[name="preferred_writer"][value="2"]').click();
			if (10 == 4) {ga('send', 'event', 'upgrade', 'click', 'anywriterpopup'); }
			//if (10 == 6) {   _gaq.push(['_trackEvent', 'upgrade', 'click', 'anywriterpopup']); }
		}else if($(this).hasClass('ab3_test_upgr')){
			$(ORDER_FORM_ID).find('[name="academic_level"][value="1003"]').click();
			$(ORDER_FORM_ID).find('[name="preferred_writer"][value="4"]').click();
			if(typeof(not_discount_modal) != "undefined" && not_discount_modal!=false){
				$(ORDER_FORM_ID).find('[name="discount_code"]').val('');
			}
			if (10 == 4) { ga('send', 'event', 'upgrade', 'click', 'anywriter_undergrad_popup');}
			//if (10 == 6) { _gaq.push(['_trackEvent', 'upgrade', 'click', 'anywriter_undergrad_popup']); }
		}
		send_from_modal(); 
		return; 
	});

	var show_form = true;



        var form_step1 = $(this).closest("form" + ORDER_FORM_ID);
        not_good =false;
        callAjaxAsyncFalse('json', '/order.html?ajax=findUser', function(data) {
            if(typeof(data) != 'undefined' && typeof(data.order_created) != 'undefined' && typeof(data.order_created.error) != 'undefined') { 
              not_good =true;        
              return false; 
           }
        },form_step1.serialize(),form_step1);   


	/*$(ORDER_FORM_ID).find("input[type='submit']").click(function() { */
	$(ORDER_FORM_ID).find("button[type='submit']").click(function() {	
		if(10 == 9 || 10 == 4 || 10 == 10){
			ga('send', 'pageview', '/virtual/proceed-to-payment');
		}	
		$(ORDER_FORM_ID).find(".modal_ac_lvl_info").text($(ORDER_FORM_ID).find("[name='academic_level']:checked").parent().text());
		if($("[name='preferred_writer']:checked").val() == 3){
			$(ORDER_FORM_ID).find(".modal_pref_wrt_info").text($(ORDER_FORM_ID).find("[name='previous_writer']").val());
		}else if($("[name='preferred_writer']:checked").val() == 2){
			$(ORDER_FORM_ID).find(".modal_pref_wrt_info").text('TOP writer');
		}else{
			$(ORDER_FORM_ID).find(".modal_pref_wrt_info").text($(ORDER_FORM_ID).find("[name='preferred_writer']:checked").parent().text());
		}

		$(ORDER_FORM_ID).find(".modal_prc_info").text($(ORDER_FORM_ID).find("#appr_price_step3").text());

		var method = $('#hide_choose_pay_system_radio').val();
		var str_method ='';
		//if ($(ELEMENT_CLASS + "#_choose_pay_system").css('display')!='none'){
		if ($(ELEMENT_CLASS + "#_choose_pay_system").css('display')!='none' || $(ORDER_FORM_ID).find("[name='domid']").length){
			if(method) { var  str_method = "&m="+method }
		}
		$('#hidden_auth_form').attr('action',attr_form+str_method)
		if (submitted) return false;
		submitted = true;
		var form = $(this).closest("form" + ORDER_FORM_ID);
		changeValidationRules(form.attr("id"), "questions", "required", true);
		changeValidationRules(form.attr("id"), "problems", "required", true);
		validateSlidesAndPages();
		if (form.valid()) {
				if($('#verify_checkbox').prop("checked")){
				$('#verify_checkbox').removeClass('checkbox-error');
				}else{
				$('#verify_checkbox').addClass('checkbox-error');
				submitted = false;
				return false;
				}
			
			        callAjax('json', '/order.html?ajax=findUser', function(data) {
                                      if(typeof(data) != 'undefined' && typeof(data.order_created) != 'undefined' && typeof(data.order_created.error) != 'undefined') { 
                                                 							submitted = false;
                                                 return false; 
                                      }
			if(show_form){
				//DISC START
				var disountVal = $.trim($(ORDER_FORM_ID).find("[name='discount_code']").val());	
				if(disountVal !=''){
					callAjax('json', '/order.html?ajax=checkDiscount', function(data) {
						if(setPromoBundles(data)){
							submitted = false;
							$('.btn-procced').trigger('click');	
							return false;
						}						
						if(typeof(data.discountResult.error) == 'undefined') { 
							$('div[error="discount_code"]').hide();
							if(typeof(data.price.error) != 'undefined') { 
								if(typeof(data.price.error.previous_writer) != 'undefined')
								{
									FORM_VALIDATORS[$(ORDER_FORM_ID).attr("id")].settings.messages.previous_writer = "This ID does not exist. Please double-check it and try again";
									changeValidationRules($(ORDER_FORM_ID).attr("id"),'previous_writer',"range",[0,0]);
								}else{
									FORM_VALIDATORS[$(ORDER_FORM_ID).attr("id")].settings.messages.previous_writer = "Please enter correct writer's ID. It should contain only numerical digits";
									changeValidationRules($(ORDER_FORM_ID).attr("id"),'previous_writer',"range",false);
								}
							}else {
								if(typeof(FORM_VALIDATORS[$(ORDER_FORM_ID).attr("id")]) != "undefined" && FORM_VALIDATORS[$(ORDER_FORM_ID).attr("id")] !== false){
									FORM_VALIDATORS[$(ORDER_FORM_ID).attr("id")].settings.messages.previous_writer = "Please enter correct writer's ID. It should contain only numerical digits";
									changeValidationRules($(ORDER_FORM_ID).attr("id"),'previous_writer',"range",false); }
							}
							if (typeof(data.price) != "undefined" && data.price !== false) {
								setPrice(data.price.price,data.price.save);
								setPlagiarism(data.price.plag);
								setSaveBundle(data.price.save,1,data.price.save_bundle);
								$(ORDER_FORM_ID).find(".modal_prc_info").text($(ORDER_FORM_ID).find("#appr_price_step3").text());					
								if(!show_modal_step3()){ return false;}
								create_order_after_modal(form);                             					
							} 
						}else{
							$('#disc_check').click();
							changeStep(2,true);		
							submitted = false;
						}	
					},  form.serialize(),$(ORDER_FORM_ID));

				} else{
					//DISC END
					if(!show_modal_step3()){ return false;}
					create_order_after_modal(form);
				}
			}else{
				var but_wait_go = $('button.wait-go');
				but_wait_go.find('.fa-spin').show();
				callAjax('json', '/order.html?ajax=create', function(data) {
					but_wait_go.find('.fa-spin').hide();
					if (typeof(data.order_created) == "boolean" && data.order_created == true) {
						if (typeof(data.order_id) != "undefined") {
							authHiddenFormSubmit(form, data.order_id, data.bill_id, data.token);
						} 
						else{
							submitted = false;
						}
					} else {
						if(typeof(data.order_created)!= "undefined" && typeof(data.order_created.error)!= "undefined" && typeof(data.order_created.error.discount_code)!= "undefined"){
							$('#disc_check').click();
							changeStep(2,true)
						}						
						submitted = false;
					}
				}
				, form.serialize()+'&paper_details='+encodeURIComponent(Base64.encode(form.find('[name="paper_details"]').val())), form)
			}
			
			        }, form.serialize(),$(ORDER_FORM_ID));
		} else {
			submitted = false;
			return false;
		}
	})	  	


	modal_count_price = false;
	not_discount_modal = false;
	price_modal_new =0;
	function show_modal_step3(){
		var popup = $("#last-step-order-form-modal");

		if($.inArray( $(ORDER_FORM_ID).find("[name='type_of_paper']").find("option:selected").val(), ['100014','100029','100031','100058','10032','100059'])>-1){
			$('.ac_lvl_head_modal').hide();
			$('.modal_ac_lvl_info').hide();
		}else{
			$('.ac_lvl_head_modal').show();
			$('.modal_ac_lvl_info').show();
		}
		$('#last-step-order-form-modal div.text_help').hide();
		if ($("[name='academic_level']:checked").val() == 1001 && $("[name='preferred_writer']:checked").val() == 1) {
			$('#last-step-order-form-modal div.text3_modal').show();
			modal_count_price =$(ORDER_FORM_ID).find('[name="type_of_paper"],[name="type_of_work"],[name="pages"],[name="slides"],[name="problems"],[name="questions"],[name="deadline"],[name="plagiarism_report"],[name="abstract_page"],[name="top_priority"],[name="discount_code"],[name="id"],[name="spacing"],[name="previous_writer"]').serialize()+'&preferred_writer=4'+'&academic_level=1003';
			var price_modal = countPrice();
			if(typeof(price_modal) == "undefined"){ price_modal = price_modal_new;}
			$(".new_price_modal").html("$"+price_modal.toFixed(2));
			modal_count_price = false;
			popup.modal({backdrop: 'static'});
			show_form = false;
			//submitted = false;
			return false;
		}else if($("[name='preferred_writer']:checked").val() == 1) {
			$('#last-step-order-form-modal div.text2_modal').show();
			modal_count_price =$(ORDER_FORM_ID).find('[name="type_of_paper"],[name="type_of_work"],[name="academic_level"],[name="pages"],[name="slides"],[name="problems"],[name="questions"],[name="deadline"],[name="plagiarism_report"],[name="abstract_page"],[name="top_priority"],[name="discount_code"],[name="id"],[name="spacing"],[name="previous_writer"]').serialize()+'&preferred_writer=2';
			var price_modal = countPrice();
			if(typeof(price_modal) == "undefined"){ price_modal = price_modal_new;}
			$(".new_price_modal").html("$"+price_modal.toFixed(2));
			modal_count_price = false;
			popup.modal({backdrop: 'static'});
			show_form = false;
			//submitted = false;
			return false;
		}else if($("[name='academic_level']:checked").val() == 1001) {
			$('#last-step-order-form-modal div.text1_modal').show();
			modal_count_price =$(ORDER_FORM_ID).find('[name="type_of_paper"],[name="type_of_work"],[name="preferred_writer"],[name="pages"],[name="slides"],[name="problems"],[name="questions"],[name="deadline"],[name="plagiarism_report"],[name="abstract_page"],[name="top_priority"],[name="discount_code"],[name="id"],[name="spacing"],[name="previous_writer"]').serialize()+'&academic_level=1003';
			var price_modal = countPrice();
			if(typeof(price_modal) == "undefined"){ price_modal = price_modal_new;}
			$(".new_price_modal").html("$"+price_modal.toFixed(2));
			modal_count_price = false;
			popup.modal({backdrop: 'static'});
			show_form = false;
			//submitted = false;
			return false;
		}
		return true;	
	}

	function create_order_after_modal(form_variable){
		var but_wait_go = $('button.wait-go');
		but_wait_go.find('.fa-spin').show();		
		callAjax('json', '/order.html?ajax=create', function(data) {
			but_wait_go.find('.fa-spin').hide();
			if (typeof(data.order_created) == "boolean" && data.order_created == true) {
				if (typeof(data.order_id) != "undefined") {
					authHiddenFormSubmit(form_variable, data.order_id, data.bill_id, data.token);
				} 
				else{
					submitted = false;
				}
			} else {
				if(typeof(data.order_created)!= "undefined" && typeof(data.order_created.error)!= "undefined" && typeof(data.order_created.error.discount_code)!= "undefined"){
					$('#disc_check').click();
					changeStep(2,true)
				}				
				submitted = false;
			}
		}
		, form_variable.serialize()+'&paper_details='+encodeURIComponent(Base64.encode(form_variable.find('[name="paper_details"]').val())), form_variable)
	}

	$('.go_to_proc').click(function(){
		if($(this).hasClass('ab1_test_nothx')){
			if (10 == 4) {  ga('send', 'event', 'nothanks', 'click', 'undergraduatepopup');}
			//if (10 == 6) { _gaq.push(['_trackEvent', 'nothanks', 'click', 'undergraduatepopup']); }
		}else if($(this).hasClass('ab2_test_nothx')){
			if (10 == 4) {  ga('send', 'event', 'nothanks', 'click', 'anywriterpopup');}
			//if (10 == 6) { _gaq.push(['_trackEvent', 'nothanks', 'click', 'anywriterpopup']);}
		}else if($(this).hasClass('ab3_test_nothx')){
			if (10 == 4) {  ga('send', 'event', 'nothanks', 'click', 'anywriter_undergrad_popup');}
			//if (10 == 6) {   _gaq.push(['_trackEvent', 'nothanks', 'click', 'anywriter_undergrad_popup']);}
		}
		send_from_modal();
	});

	function send_from_modal(){
		form_modal = $("form" + ORDER_FORM_ID);
		validateSlidesAndPages();
		if (form_modal.valid()) {
			var but_wait_go = $('button.wait-go');
			but_wait_go.find('.fa-spin').show();			
			callAjax('json', '/order.html?ajax=create', function(data) {
				but_wait_go.find('.fa-spin').hide();
				if (typeof(data.order_created) == "boolean" && data.order_created == true) {
					if (typeof(data.order_id) != "undefined") {
						authHiddenFormSubmit(form_modal, data.order_id, data.bill_id, data.token);
					} 
					else{
						submitted = false;
					}
				} else {
					if(typeof(data.order_created)!= "undefined" && typeof(data.order_created.error)!= "undefined" && typeof(data.order_created.error.discount_code)!= "undefined"){
						$('#disc_check').click();
						changeStep(2,true)
					}					
					submitted = false;
				}
			}
			, form_modal.serialize()+'&paper_details='+encodeURIComponent(Base64.encode(form_modal.find('[name="paper_details"]').val())), form_modal)
		} else {
			submitted = false;
			return false;
		}
	}


	var Base64 = {

		// private property
		_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

		// public method for encoding
		encode : function (input) {
			var output = "";
			var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
			var i = 0;

			input = Base64._utf8_encode(input);

			while (i < input.length) {

				chr1 = input.charCodeAt(i++);
				chr2 = input.charCodeAt(i++);
				chr3 = input.charCodeAt(i++);

				enc1 = chr1 >> 2;
				enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
				enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
				enc4 = chr3 & 63;

				if (isNaN(chr2)) {
					enc3 = enc4 = 64;
				} else if (isNaN(chr3)) {
					enc4 = 64;
				}

				output = output +
					this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
					this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

			}

			return output;
		},

		// public method for decoding
		decode : function (input) {
			var output = "";
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;

			input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

			while (i < input.length) {

				enc1 = this._keyStr.indexOf(input.charAt(i++));
				enc2 = this._keyStr.indexOf(input.charAt(i++));
				enc3 = this._keyStr.indexOf(input.charAt(i++));
				enc4 = this._keyStr.indexOf(input.charAt(i++));

				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;

				output = output + String.fromCharCode(chr1);

				if (enc3 != 64) {
					output = output + String.fromCharCode(chr2);
				}
				if (enc4 != 64) {
					output = output + String.fromCharCode(chr3);
				}

			}

			output = Base64._utf8_decode(output);

			return output;

		},

		// private method for UTF-8 encoding
		_utf8_encode : function (string) {
			string = string.replace(/\r\n/g,"\n");
			var utftext = "";

			for (var n = 0; n < string.length; n++) {

				var c = string.charCodeAt(n);

				if (c < 128) {
					utftext += String.fromCharCode(c);
				}
				else if((c > 127) && (c < 2048)) {
					utftext += String.fromCharCode((c >> 6) | 192);
					utftext += String.fromCharCode((c & 63) | 128);
				}
				else {
					utftext += String.fromCharCode((c >> 12) | 224);
					utftext += String.fromCharCode(((c >> 6) & 63) | 128);
					utftext += String.fromCharCode((c & 63) | 128);
				}

			}

			return utftext;
		},

		// private method for UTF-8 decoding
		_utf8_decode : function (utftext) {
			var string = "";
			var i = 0;
			var c = c1 = c2 = 0;

			while ( i < utftext.length ) {

				c = utftext.charCodeAt(i);

				if (c < 128) {
					string += String.fromCharCode(c);
					i++;
				}
				else if((c > 191) && (c < 224)) {
					c2 = utftext.charCodeAt(i+1);
					string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
					i += 2;
				}
				else {
					c2 = utftext.charCodeAt(i+1);
					c3 = utftext.charCodeAt(i+2);
					string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
					i += 3;
				}

			}

			return string;
		}

	}

})