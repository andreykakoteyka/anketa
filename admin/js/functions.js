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
        }
    });
//</getGroups>
//<chain>
    $('#facultyFilter').chained('#stageOfStudyingFilter');
    $('#groupFilter').chained('#facultyFilter');
//</chain>
}
