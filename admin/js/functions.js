function loadStrings(async) {
    if(allow_request) {
        allow_request = false;
        $.ajax({
            url: 'getStrings.php',
            type: 'POST',
            data: 'start=' + start
            + '&fio=' + $('#search-base-input').val()
            + ($('#stageOfStudyingFilter>option:selected').val() ? '&stageOfStudying=' + $('#stageOfStudyingFilter>option:selected').prop('innerHTML') : '&stageOfStudying=')
            + ($('#facultyFilter>option:selected').val() ? '&faculty=' + $('#facultyFilter>option:selected').prop('innerHTML') : '&faculty=')
            + ($('#groupFilter>option:selected').val() ? '&group=' + $('#groupFilter>option:selected').prop('innerHTML') : '&group=')
            + ($('#phoneFilter').val() ? '&phone=' + $('#phoneFilter').prop('value') : '&phone=')
            + ($('#emailFilter').val() ? '&email=' + $('#emailFilter').val() : '&email='),
            dataType: 'text',
            async: (async == 'undefined' ? true : async),
            success: function (msg) {
                if (!start) {
                    $('#base tbody').html(msg)
                }
                else {
                    $('#base tbody').append(msg)
                }
                allow_request = true;

                //show preview on click on row
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
                                var dateStr = response["added"];
                                var t = dateStr.split(/[- :]/);//date array
                                var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);

                                $("#date").html("" + t[2] + "." + t[1] + "." + t[0]);//дата создания анкеты, а не текущая
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
            },
            error: function (err, errText) {
                start -= 30;
                $('#db-error').modal('show');
                console.log(errText);
                allow_request = true;
            }

        });

        $('.delete').click(function () {
            string_to_delete = $(this).parent().parent();
            $('#accept-delete').modal('show');
        });
    }
}

function getFaculties(){
    $.ajax({
        url:"getFaculties.php",
        type: 'GET',
        data: 'stageOfStudying=' + $('#stageOfStudyingSelect').get(0).selectedOptions[0].value,
        async:false,
        success:function(msg){
            $('table#faculties tbody').html(msg);
            $('table#faculties tbody>tr:first-child').addClass('selected');
            $('table#faculties tbody>tr>td').click(function(){
                $('table#faculties tbody>tr').removeClass('selected');
                $(this).parent().addClass('selected');
                getGroups();
            });

        }
    });

    $('.deleteFaculty').click(function(){
        string_to_delete = $(this).parent().parent();
        $('#accept-delete-faculty').modal('show');
    });
}


function getGroups(){
    $.ajax({
        url:"getGroups.php",
        type: 'GET',
        data: 'faculty=' + $('table#faculties tr.selected').attr('value'),
        async:false,
        success:function(msg){
            $('table#groups tbody').html(msg);
        }
    });

    $('.deleteGroup').click(function(){
        string_to_delete = $(this).parent().parent();
        $('#accept-delete-group').modal('show');
    });
}

function getFilter(){
    //	//<getFaculties>
    $.ajax({
        url:"getFacultiesForFilter.php",
        async:false,
        success:function(msg){
            $('#facultyFilter').html(msg);
        }
    });
//</getFaculties>
//<getGroups>
    $.ajax({
        url:"getGroupsForFilter.php",
        async:false,
        success:function(msg){
            $('#groupFilter').html(msg);
        },
        error: function(){
            $("db-error").modal("show");
        }
    });
//</getGroups>
//<chain>
    $('#facultyFilter').chained('#stageOfStudyingFilter');
    $('#groupFilter').chained('#facultyFilter');
//</chain>
}
