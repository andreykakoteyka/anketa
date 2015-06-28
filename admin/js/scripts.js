var start = $('#base tbody>tr').length;
var string_to_delete;
var allow_request = true;

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
        //clearIncomplete: true,
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
        $('#phoneFilter').inputmasks(maskOpts);
    } else {
        $('#phoneFilter').inputmask("+[####################]", maskOpts.inputmask)
            .attr("placeholder", $('#phone').inputmask("getemptymask"));
        $("#descr").html("Маска ввода");
    }
});

$('#phone_mask').change();
//<!---маскирование мобильника--->
//filter
getFilter();
//!filter
loadStrings(false);

$(window).scroll(function(){
    if(($('html,body').scrollTop() + 60) % $('body').height() && $('#base').is('.active')){
        start += 30;
        loadStrings();
    }
});


$('#reload-base').click(function(){
    start = 0;
    $('db-error').modal('hide');
    loadStrings();
});


//	//<getFaculties>
getFaculties();
//</getFaculties>
//<getGroups>
getGroups();
//</getGroups>

//<chain>
    $('#stageOfStudyingSelect').change(function () {
        getFaculties();
        getGroups();
    });



//</chain>

/*$("#save-base").click(function(){
    $.ajax({
        url:"save_base.php",
        async:true
        });
});*/
//add faculty/group
$('#addFacultyButton').click(function(){
    $('#add-faculty-modal').modal('show');
    $('#addFacultyStageOfStudyingSelect>option:selected').each(function(){
        this.selected = false;
    });
    $('#addFacultyStageOfStudyingSelect>option[value=' + $('#stageOfStudyingSelect').get(0).selectedOptions[0].value +']').prop('selected', true);
});


$('#addGroupButton').click(function(){
    $.ajax({
        url:"/getFaculties.php",
        async:false,
        success:function(msg){
            $('#add-group-faculty-select').html(msg);
        }
    });



    $('#addGroupStageOfStudyingSelect :selected').each(function(){
        this.selected = false;
    });
    $('#addGroupStageOfStudyingSelect>option[value=' + $('#stageOfStudyingSelect').get(0).selectedOptions[0].value +']').prop('selected', true);

    $('#add-group-faculty-select').chained('#addGroupStageOfStudyingSelect');

    $('#add-group-faculty-select :selected').each(function(){
        this.selected = false;
    });

    $('#add-group-faculty-select>option[value=' + $('table#faculties>tbody>tr.selected').attr('value') +']').prop('selected', true);


    $('#add-group-modal').modal('show');
});


//------------add faculty/group

$('#add-faculty').click(function(){
    $.ajax({
        url: 'addFaculty.php',
        type: 'POST',
        data: 'facultyName=' + $('#facultyName').val() + '&addFacultyStageOfStudyingSelect=' + $('#addFacultyStageOfStudyingSelect').get(0).selectedOptions[0].value,
        success: function(msg){


            if(msg != 'error'){

                getFaculties();
                $('table#faculties tr.selected').removeClass('selected');
                $('table#faculties tr[value=' + msg +']>td:not(.deleteFaculty)').click();
                getGroups();
                $('#add-faculty-modal').modal('hide');
                $('#facultyName').val('');
                getFilter();

            }
            else{
                $('#addWithError').modal('show');
            }
        },
        error: function( err, text){
            console.log(text);
            $('#addWithError').modal('show');
        }
    })
});

$('#add-group').click(function(){
    $.ajax({
        url: 'addGroup.php',
        type: 'POST',
        data: 'facultyClass=' + $('#add-group-faculty-select').get(0).selectedOptions[0].value + '&groupName=' + $('#groupName').val() ,
        success: function(msg){


            if(msg != 'error'){;
                getGroups();
                $('#add-group-modal').modal('hide');
                $('#groupName').val('');
                getFilter();

            }
            else{
                $('#addWithError').modal('show');
            }
        },
        error: function( err, text){
            console.log(text);
            $('#addWithError').modal('show');
        }
    })
});




$('#delete').click(function(){
    $('#accept-delete').modal('hide');
    string_to_delete.hide(500);
    $.ajax({
        url:'deleteString.php',
        type: 'POST',
        data: 'index=' + string_to_delete.children('.index').prop('innerHTML'),
        success: function(){
            $('#successfulDeleted').modal('show');
        },
        error: function(){
            $('#deletedWithError').modal('show');
        }
    });
});
$('#delete-faculty').click(function(){
    $('#accept-delete-faculty').modal('hide');
    string_to_delete.hide(500);
    $.ajax({
        url:'deleteFaculty.php',
        type: 'POST',
        data: 'index=' + string_to_delete.children('.index').prop('innerHTML'),
        success: function(){
            getFilter();
            $('#successfulDeleted').modal('show');
            $('#faculties>tr:first-child').click();
        },
        error: function(){
            $('#deletedWithError').modal('show');
        }
    });
});
$('#delete-group').click(function(){
    $('#accept-delete-group').modal('hide');
    string_to_delete.hide(500);
    $.ajax({
        url:'deleteGroup.php',
        type: 'POST',
        data: 'index=' + string_to_delete.children('.index').prop('innerHTML'),
        success: function(){
            getFilter();
            $('#successfulDeleted').modal('show');
        },
        error: function(){
            $('#deletedWithError').modal('show');
        }
    });
});

$('#base table.table-hover>tbody>tr>td:not(:last-child)').click(function(){
    $.ajax({
        url: 'getPreview.php',
        //dataType: 'text',
        type: 'GET',
        data: 'index=' + $(this).parent().children('.index').get(0).innerHTML,
        success: function(msg){
            if(msg != 'error') {
                var response = $.parseJSON(msg);
                //alert(response["firstName_value"]);
                var tags = $('#preview .value');
                //alert(response["firstName_value"]);
                for (i = 0; i < tags.length; i++) {
                    //alert(response[tegs.get(i).id]);
                    if (tags.get(i).id != 'phone_value') {

                        tags[i].innerHTML = response[tags.get(i).id];
                    }
                    else {
                        tags[i].innerHTML = '+' + response[tags.get(i).id];
                    }

                    if ($.trim(response[tags.get(i).id]) == "") {
                        $('#' + tags[i].id).addClass('hidden');
                    }
                    else {
                        $('#' + tags[i].id).removeClass('hidden');
                    }

                }
                if ($.trim(response['hadAJobAtLastYearSt_value']) == "Нет") {
                    $('#lastYearStWorkplace_value').parent().parent().parent().addClass('hidden');
                }
                else {
                    $('#lastYearStWorkplace_value').parent().parent().parent().removeClass('hidden');
                }
                if ($.trim(response['haveAJobNow_value']) == "Нет") {
                    $('#currentTimeWorkplace_value').parent().parent().parent().addClass('hidden');
                }
                else {
                    $('#currentTimeWorkplace_value').parent().parent().parent().removeClass('hidden');
                }
                if ($.trim(response['goingToGetAJob_value']) != "планируете трудоустроиться") {
                    $('#goingToGetAJob_value').parent().addClass('hidden');
                }
                else {
                    $('#goingToGetAJob_value').parent().removeClass('hidden');
                }
                if ($.trim(response['goingToGetAJobWorkplace_value']) == "") {
                    $('#goingToGetAJobWorkplace_value').parent().addClass('hidden');
                }
                else {
                    $('#goingToGetAJobWorkplace_value').parent().removeClass('hidden');
                }
                if ($.trim(response['goingToGetAJobPost_value']) == "") {
                    $('#goingToGetAJobPost_value').parent().addClass('hidden');
                }
                else {
                    $('#goingToGetAJobPost_value').parent().removeClass('hidden');
                }
                if ($.trim(response['hsenn_value']) == ""
                    && $.trim(response['hseMoscow_value']) == ""
                    && $.trim(response['goingToGetAJob_value']) == ""
                    && $.trim(response['otherCheckbox_value']) == ""
                    && $.trim(response['otherHE_value']) == "") {
                    $('#afterStudying').addClass('hidden');
                }
                else {
                    $('#afterStudying').removeClass('hidden');
                }

                $('#preview').modal('show');
            }
            else{
                $('#previewError').modal('show');
            }
        },
        error: function(){
            $('#previewError').modal('show');
        }
    })
});

$('#search-base-button').click(function(e){
    e.preventDefault();
    start = 0;
    loadStrings(true);
});

$('#submit-filter').click(function(e){
    e.preventDefault();
    $('#search-base-button').click();
});

$('#print').click(function(){
    $('#printBody').html($('#preview .modal-body').html());
    window.print();
});


