var jsonToValidate;
var json;
var colorizeAll = false;
var showPreviewButton = false;

function getWidthOfWorkplace()
{
	if(document.all)
	{
		return document.body.clientWidth;
	}
	else
	{
		return innerWidth;
	}
}

function getHeightOfWorkplace()
{
	if(document.all)
	{
		return document.body.clientHeighth;
	}
	else
	{
		return innerHeight;
	}
}




function validateEmail(){
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		if(pattern.test($('input[name=email]').val()) && $('input[name=email]').val() != ''){
			$('input[name=email]').parent().removeClass('has-error');
			$('input[name=email]').parent().addClass('has-success');

		} else {
			$('input[name=email]').parent().removeClass('has-success');
			$('input[name=email]').parent().addClass('has-error');

		};
}
function validateMobilePhone()
{
	var value = $('#phone').val();
	var pattern = /^\+?[0-9]{1,3}\(?[0-9]{3}\)?[0-9]{3}-?[0-9]{2}-?[0-9]{2}/i;
	if (pattern.test(value) /*|| $('#dontHavePhone').prop('checked')*/)
	{
		$('input[name=phone]').parent().removeClass('has-error');
		$('input[name=phone]').parent().addClass('has-success');

	} else {
		$('input[name=phone]').parent().removeClass('has-success');
		$('input[name=phone]').parent().addClass('has-error');
	}
}

function validateFirstName()
{
	var value = $('input[name=firstName]').val();
	if (value.length >= 2)
	{
		$('input[name=firstName]').parent().removeClass('has-error');
		$('input[name=firstName]').parent().addClass('has-success');

	} else {
		$('input[name=firstName]').parent().removeClass('has-success');
		$('input[name=firstName]').parent().addClass('has-error');
	}
}
function validateFamilyName()
{
	var value = $('input[name=familyName]').val();
	if (value.length >= 2)
	{
		$('input[name=familyName]').parent().removeClass('has-error');
		$('input[name=familyName]').parent().addClass('has-success');

	} else {
		$('input[name=familyName]').parent().removeClass('has-success');
		$('input[name=familyName]').parent().addClass('has-error');
	}
}

function validateLastName()
{
	var value = $('input[name=lastName]').val();
	if (value.length >= 2)
	{
		$('input[name=lastName]').parent().removeClass('has-error');
		$('input[name=lastName]').parent().addClass('has-success');

	} else {
		$('input[name=lastName]').parent().removeClass('has-success');
		$('input[name=lastName]').parent().addClass('has-error');
	}
}

function validateBirthDate()
{
	var value = $('input[name=birthDate]').val();
	if (value.length >= 2)
	{
		$('input[name=birthDate]').parent().removeClass('has-error');
		$('input[name=birthDate]').parent().addClass('has-success');

	} else {
		$('input[name=birthDate]').parent().removeClass('has-success');
		$('input[name=birthDate]').parent().addClass('has-error');
	}
}
function validateAll(){
	validateBirthDate();
	validateEmail();
	validateFamilyName();
	validateFirstName();
	validateLastName();
	validateMobilePhone();
}

function checkAnswers(notColorize)
{
	if(typeof notColorize == 'undefined'){
		notColorize = false;
	}
	var error = false;


	if(!notColorize || colorizeAll)
	{
		validateAll();
	}

	if($('.form-group').not('.has-success').length){
		error = true;
	};
    if(!notColorize || colorizeAll){
        if (!error)
		{
            $('#showPreview').removeClass('btn-danger');
			$('#showPreview').addClass('btn-active');
        }
        else
        {
			$('#showPreview').removeClass('btn-active');
			$('#showPreview').addClass('btn-danger');
        }
    }
	return !error;
}

function buildJson(){
	
	var textBoxes = $("#anketa input:text[name],input[type=email][name]");
	var selects = $("#anketa select[name]");
	var radios = $("#anketa input:radio[name]");
	var checkboxes = $("#anketa input:checkbox[name]");
	var tel = $('#anketa input[type=tel][name]');
	json = [];
	textBoxes.each(function(i,item){
		if(!item.classList.contains('appendix')) {
			json[item.name] = {
				'name': item.name,
				'value': $.trim(item.value) ? $.trim(item.value) : '---'

			};
		}
	});
	tel.each(function(i,item){
		json[item.name] = {
			'name':item.name,
			'value':$.trim(item._valueGet())?$.trim(item._valueGet()):'---'

		};
	});
	selects.each(function(i,item){
		json[item.name]={
				'name': item.name,
				'value': $.trim(item.selectedOptions[0].innerHTML)?$.trim(item.selectedOptions[0].innerHTML):'---'
		};
	});
	radios.each(function(i,item){
		if(item.checked) {
			json[item.name] = {
				'name': item.name,
				'value': $.trim(item.nextElementSibling.innerHTML)
			};
		}
	});
	checkboxes.each(function(i,item){
		if(item.checked) {
			json[item.name] = {
				'name': item.name,
				'value': $.trim(item.nextSibling.data)
			};
			if($("#anketa input:text[name=" + item.name + "Input]").length) {
				json[item.name].value += $("#anketa input:text[name=" + item.name + "Input]").val()?" (" +  $("#anketa input:text[name=" + item.name + "Input]").val() + ')' :'';
			}
		}
	});
	
}
function buildPreview(){

	for (i in json){
		$('#' + i + 'Preview').html(json[i].value);
	}
	$('#phonePreview').html($.trim($('input#phone').get(0)._valueGet()));

	if(json['haveAJobNow'].value == 'Нет'){
		$('#currentTimeWorkplacePreview').parent().parent().parent().hide();
		json['currentTimeWorkplace'].value = "";
		json['currentTimePost'].value = "";
	}
	else
	{
		$('#currentTimeWorkplacePreview').parent().parent().parent().show();
	}

	if(json['hadAJobAtLastYearSt'].value == 'Нет'){
		$('#lastYearStWorkplacePreview').parent().parent().parent().hide();
		json['lastYearStWorkplace'].value = "";
		json['lastYearStPost'].value = "";
	}
	else
	{
		$('#lastYearStWorkplacePreview').parent().parent().parent().show();
	}

	$('#anketa input:checkbox[name]').each(function(i, item) {
		if(item.checked){
			$('#' + item.name + 'Preview').show();
		}
		else
		{
			$('#' + item.name + 'Preview').hide();
		}

	});
	var afterStudiyngShow = false;
	$('.afterGraduate').each(function(i, item){
		if(item.checked){
			afterStudiyngShow = true;
		}
	});
	if(!$('#goingToGetAJob:checked').length){
		$('#goingToGetAJobWorkplacePreview').parent().parent().parent().hide();
	}
	else{
		$('#goingToGetAJobWorkplacePreview').parent().parent().parent().show();
	}
	if(afterStudiyngShow)
	{
		$('#afterStudyingPreview').show();
	}
	else
	{
		$('#afterStudyingPreview').hide();
	}

}

function getChar(event) {
  if (event.which == null) {  // IE
    if (event.keyCode < 32) return null; // спец. символ
    return String.fromCharCode(event.keyCode)
  }
 
  if (event.which!=0 && event.charCode!=0) { // все кроме IE
    if (event.which < 32) return null; // спец. символ
    return String.fromCharCode(event.which); // остальные
  }
 
  return null; // спец. символ
}



function GoingToGetAJobChange(){
    if ($('#goingToGetAJob').prop('checked'))
		{
			$('#goingToGetAJobPost').parent().parent().fadeIn(1500);
		}
		else
		{

			$("#goingToGetAJobWorkplace").val('');
			$("#goingToGetAJobPost").val('');
			$("#goingToGetAJobPost").parent().parent().fadeOut(1500);
		}
    
}

function OtherHEChange(){
    if ($('#otherHE').prop('checked'))
		{
			$('#otherHEInput').parent().fadeIn(1500);
		}
		else
		{
			$('#otherHEInput').parent().fadeOut(1500);
			$('#otherHEInput').val('');
		}
}

function otherCheckboxChange(){
   if ($('#otherCheckbox').prop('checked'))
		{
			$('#otherCheckboxInput').parent().fadeIn(1500);
		}
		else
		{
			$('#otherCheckboxInput').parent().fadeOut(1500);
			$('#otherCheckboxInput').val('');
		}
    
}



