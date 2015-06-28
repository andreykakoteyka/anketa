
    //<---fullscreen header--->
    $('.fullscreen').height(getHeightOfWorkplace());
    //<!--fullscreen header--->
    //<---прокрутка по стрелке--->
    $('#arrow').click(function() {
		var heightOfWorkplace = getHeightOfWorkplace();
		$("html,body").animate({"scrollTop": heightOfWorkplace}, "slow");
	});
	//<!---прокрутка по стрелке--->
    //<---datepicker--->
	var currentDate = new Date();
	currentDate.addYears(-20);
    $('.datepicker').pickmeup({
		format: 'd.m.Y',
		position: 'right',
		hide_on_select: true,
		first_day: 1,
		default_date : currentDate,
		view : 'years',
		locale: {
				days:["Восресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье"],
				daysShort:["Вскр","Пн","Вт","Ср","Чт","Птн","Сб","Вскр"],
				daysMin:["Вс","Пн","Вт","Ср","Чт","Пт","Сб","Вс"],
				months:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
				monthsShort:["Янв","Фев","Мрт","Апр","Май","Июн","Июл","Авг","Сен","Окт","Нояб","Дек"]
			}
	});
	$('.datepicker').focus(function(e) {
        $('.datepicker').pickmeup('show');
    });
    //<!---datepicker--->

    //<---маскирование мобильника--->
	////////////////////
		var maskList = $.masksSort($.masksLoad("../json/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
		var maskOpts = {
			inputmask: {
				definitions: {
					'#': {
						validator: "[0-9]",
						cardinality: 1
					}
				},
				clearIncomplete: true,
				showMaskOnHover: false,
				autoUnmask: true
			},
			match: /[0-9]/,
			replace: '#',
			list: maskList,
			listKey: "mask",
			onMaskChange: function(maskObj, completed) {
				if (completed) {
					var hint = maskObj.name_ru;
					if (maskObj.desc_ru && maskObj.desc_ru != "") {
						hint += " (" + maskObj.desc_ru + ")";
					}
					$("#descr").html(hint);
				} else {
					$("#descr").html("Маска ввода");
				}
				$(this).attr("placeholder", $(this).inputmask("getemptymask"));
			}
		};
	
		$('#phone_mask').change(function() {
			if ($('#phone_mask').is(':checked')) {
				$('#phone').inputmasks(maskOpts);
			} else {
				$('#phone').inputmask("+[####################]", maskOpts.inputmask)
				.attr("placeholder", $('#phone').inputmask("getemptymask"));
				$("#descr").html("Маска ввода");
			}
		});
	
		$('#phone_mask').change();
	//<!---маскирование мобильника--->
    
	//<---blur--->
		$('.name').blur(function(){
            var str = $(this).val();
            if(str == "") return false; 
            str = str[0].toUpperCase() + str.substring(1,str.length);
            $(this).val(str);
        });

        $('#phone').blur(function(e) {
			//if($(this).val()){
			//	$('#dontHavePhone').prop('checked',false);;
			//}
			//else
			//{
			//	$('#dontHavePhone').prop('checked',true)
			//}
			validateMobilePhone();
		});
	//<!---blur--->

	//<!---onClick--->

	$('#showPreview').click(function(){
		colorizeAll = true;
		if(checkAnswers())
		{
			buildJson();
			buildPreview();
			$('#preview').modal('show');
		}
		else{
			$("html,body").animate({"scrollTop": getHeightOfWorkplace()}, "slow");
		}
	});

	/*$('#dontHavePhone').click(function(e) {
		if($(this).prop('checked')){
       	$('#phone').val('');
		}
		else
		{
			if($('#phone').val() == ''){
				$('#phone').val(7);
			}
		}
		validateMobilePhone();
   });*/

	$('#accept').click(function(){
		if(!$(this).is('.btn-active')) {
			$('#finishModal').modal('show');
			return false;
		}
		if(!$('input:checkbox[name=savingHandlingData]').prop('checked'))
		{
			$('#warning').modal('show');
			return false;
		}

		var jsonToSend = new Array();
		for(i in json){
			jsonToSend.push(json[i])
		}
		$('#accept>.preloader').show();
		$.ajax({
			url:"../ajax.php",
			type:'POST',
			dataType:"text",
			data:'json=' + JSON.stringify(jsonToSend),
			success: function(msg){
				$('#accept').removeClass('btn-active').addClass('btn-inactive');
				console.log(msg);
				$('#printBody').html($('#preview .modal-body').html());
				$('#accept>.preloader').fadeOut(150);
				$('#anketa input,select').attr('disabled',true);
				$('#finishModal').modal('show');
			},
			error: function(err,msg){
				console.log(msg);
				console.log('error');
				console.log(json);
				$('#accept>.preloader').fadeOut(150);
				$('#error').modal('show');
			}
		});

	});
	$('#print').click(function(){
		window.print();
	});
	$('#saveAsDocument').click(function(){
		//var pdf = new jsPDF();
        //
		//var specialElementHandlers = {
		//	'#editor': function(element, renderer){
		//		return true;
		//	}
		//};
		//var element = $('#page-to-print');
		//element.css({ 'display': 'block !important',
		//'visibility': 'visible !important',
		//'width': '650px',
		//"break-inside":'avoid'});
        //
		//pdf.fromHTML(document.getElementById('page-to-print'), 15, 15, {
		//	'width': 170,
		//	'elementHandlers': specialElementHandlers
		//});
		//pdf.save();
	});
	//<!---onClick--->
	//	//<getFaculties>
		$.ajax({
			url:"../getFaculties.php",
			async:false,
			success:function(msg){
				$('#faculty').html(msg);
			}
		});
	//</getFaculties>
	//<getGroups>
		$.ajax({
			url:"../getGroups.php",
			async:false,
			success:function(msg){
				$('#group').html(msg);
			}
		});
	//</getGroups>
	//<chain>
		$('#faculty').chained('#stageOfStudyingSelect');
		$('#group').chained('#faculty');
	//</chain>
	$('input:radio[name=stageOfStudying]').change(function(){
		$("#stageOfStudyingSelect").prop('selectedOptions',$('.stageOfStudying:checked').get(0));
		$("#stageOfStudyingSelect").val($('.stageOfStudying:checked').val());
		$("#stageOfStudyingSelect").change();
		if($(this).val() == 'mag'){
			$('#hsenn,#hseMoscow,#otherHE,#otherHEInput').parent().fadeOut(1500);
			$('#hsenn,#hseMoscow,#otherHE').prop('checked',false);
			$('#otherHEInput').val('');

			$('#otherCheckboxInput').parent().parent().fadeOut(1500);
			$('#otherCheckboxInput').val('');
			$('#otherCheckbox').prop('checked', false);
		}
		else
		{
			$('#hsenn,#hseMoscow,#otherHE').parent().fadeIn(1500);
			$('#otherCheckboxInput').parent().parent().fadeIn(1500);
			$('#otherCheckboxInput').parent().hide();
		}
	});

	$('input:radio[name=haveAJobNow]').change(function(){
		if($(this).val() == 'Да'){
			$('#currentTimeJob').fadeIn(1000);
			$("#goingToGetAJob").parent().fadeOut(1000);
			$("#goingToGetAJob").prop('checked',false);
			$("#goingToGetAJobWorkplace").val('');
			$("#goingToGetAJobPost").val('');
			$("#goingToGetAJobPost").parent().parent().fadeOut();
		}
		else
		{
			$('#currentTimeJob').fadeOut(1000);
			$('#currentTimeWorkplace, #currentTimePost').val('');
			$("#goingToGetAJob").parent().fadeIn(1000);
		}
	});

	$('input:radio[name=hadAJobAtLastYearSt]').change(function(){
		if($(this).val() == 'Да'){
			$('#lastYearStJob').fadeIn(1500);
		}
		else
		{
			$('#lastYearStJob').fadeOut(1500);
			$('#lastYearStWorkplace, #lastYearStPost').val('');
		}
	});
	$('#goingToGetAJob').click(function(){
		GoingToGetAJobChange();
	});

	$('#otherHE').click(function(){
		OtherHEChange();
	});
	$('#otherCheckbox').click(function(){
		otherCheckboxChange();
	});
	//<!---onchange--->

	//<----вывод и скрытие полей--->
	if($('input:checkbox[name=otherHE]').prop('checked'))
	{
		$('#otherHEInput').parent().show();
	}
	else
	{
		$('#otherHEInput').parent().hide();
	}


	if($('input:checkbox[name=goingToGetAJob]').prop('checked'))
	{

		$("#goingToGetAJobPost").parent().parent().fadeIn();
	}
	else
	{
		$("#goingToGetAJobWorkplace").val('');
		$("#goingToGetAJobPost").val('');
		$("#goingToGetAJobPost").parent().parent().fadeOut()
	}





	var haveAJobNow = false;
	$('input:radio[name=haveAJobNow]').each(function(i, item){
		if(item.checked && item.value == "Да"){
			haveAJobNow = true;
		}
	});
	if(haveAJobNow){
		$('#currentTimeJob').show();
		$("#goingToGetAJob").parent().hide();
		$("#goingToGetAJobWorkplace").val('');
		$("#goingToGetAJobPost").val('');
		$("#goingToGetAJobPost").parent().parent().fadeOut()
	}
	else
	{
		$('#currentTimeJob').hide();
		$("#goingToGetAJob").parent().show();
	}


	var hadJobAtLastYearSt = false;
	$('input:radio[name=hadAJobAtLastYearSt]').each(function(i, item){
		if(item.checked && item.value == "Да"){
			hadJobAtLastYearSt = true;
		}
	});
	if(hadJobAtLastYearSt)
	{
		$('#lastYearStJob').show();
	}
	else
	{
		$('#lastYearStJob').hide();
		$('#lastYearStWorkplace, #lastYearStPost').val('');
	}

	$('#anketa input,select').removeAttr('disabled');


	var date = new Date();
	$('#currentDate').html('Дата: ' + (date.getDate() < 10?'0' + date.getDate(): date.getDate()) + '.' + date.getMonth() + '.' + date.getFullYear());

	$("#stageOfStudyingSelect").prop('selectedOptions',$('.stageOfStudying:checked').get(0));
	$("#stageOfStudyingSelect").val($('.stageOfStudying:checked').val());
	$("#stageOfStudyingSelect").change();
	if($('#stageOfStudyingSelect').val() == 'mag'){
		$('#hsenn,#hseMoscow,#otherHE,#otherHEInput').parent().fadeOut(1500);
		$('#hsenn,#hseMoscow,#otherHE').prop('checked',false);
		$('#otherHEInput').val('');

		$('#otherCheckboxInput').parent().parent().fadeOut(1500);
		$('#otherCheckboxInput').val('');
		$('#otherCheckbox').prop('checked', false);
	}
	else
	{
		$('#hsenn,#hseMoscow,#otherHE').parent().fadeIn(1500);
		$('#otherCheckboxInput').parent().parent().fadeIn(1500);
		if($('input:checkbox[name=otherCheckbox]').prop('checked'))
		{
			$('#otherCheckboxInput').parent().show();
		}
		else
		{
			$('#otherCheckboxInput').parent().hide();
		}
	}

	$(window).scroll();

	//<!----вывод и скрытие полей--->

$(window).resize(function(){
    //fullscreen header
    $('.fullscreen').height(getHeightOfWorkplace());
    ////////////
});

$(window).scroll(function(){
        var heightOfWorkplace = getHeightOfWorkplace();
        var show = true;
        if (($(window).scrollTop() >= ($('body').height()-heightOfWorkplace-60)) && (parseInt($('#showPreview').parent().parent().css('bottom')) < 0)) {

            $('#showPreview').parent().parent().animate({'bottom':'0px'});
            showPreviewButton = true;
        }
        else
        {

            if($(window).scrollTop() > heightOfWorkplace/100*15)
            {
                if(!showPreviewButton){
                    //
                    show = false;
                }
            }
            else
            {
                show = false;
            }
        }
    if(show)
    {
          checkAnswers(true);
          $('#showPreview').parent().parent().stop().animate({'bottom':'0px'});
    }
    else
    {
        $('#showPreview').parent().parent().stop().animate({'bottom':'-60px'});
    }

});
