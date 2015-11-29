<!DOCTYPE html>
<?php
include("../functions.php");

$mysqli = connectDB();

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
	$query = $mysqli->query("SELECT user_id FROM users WHERE user_id='".$_COOKIE['id']."', user_hash='".$_COOKIE['hash']."'");
	if(!isset($query))
	{
		header("Location: login.php");
	}
}
else{
  header("Location: login.php");
}

$mysqli->close();
?>
<html>
  <head>
    <title>Анкета выпускника | Панель управления</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="page-header"><img src="../img/logo-preview.png" class="logo"></div>
    <div class="container">
      <div class="tabbable">
        <ul class="nav nav-tabs">
          <li class="active"> <a href="#base" data-toggle="tab">База данных</a></li>
          <li><a href="#settings" data-toggle="tab">Факультеты & группы</a></li>
        </ul>
        <div class="tab-content">
          <div id="base" class="tab-pane active">

            <button onclick="location.href='/'" ><i class="glyphicon glyphicon-pencil"></i>Создать анкету</button>
            <button onclick="location.href='save_base.php'"><i class="glyphicon glyphicon-file"></i>Выгрузить базу в Excel</button>
            <form>
              <input id="search-base-input" class="col-lg-8" placeholder="ФИО...">
              <button id="search-base-button" class="btn"><i id="search" class="glyphicon glyphicon-search" ></i>Поиск</button>
            </form>
            <div class="panel-group" id="filter">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      Фильтр
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-inline">
                      <div class="container">
                        <!--label>Применять фильтр <input type="checkbox" id="useFilter" name="useFilter"></label!-->
                        <div class="row">
                            <label>Уровень обучения <select id="stageOfStudyingFilter" name="stageOfStudyingFilter" class="form-control">
                              <option value="">Любой</option>
                              <option value="bach">Бакалавриат</option>
                              <option value="mag">Магистратура</option>
                            </select>
                          </label>
                          <label>Факультет <select id="facultyFilter" name="facultyFilter" class="form-control">\

                            </select>
                          </label>
                          <label>Группа <select id="groupFilter" name="groupFilter" class="form-control">

                            </select>
                          </label>
                        </div>
                        <div class="row">
                          <label>
                              E-mail <input type="email" id="emailFilter" name="emailFilter"  class="form-control"/>
                          </label>
                        </div>
                        <div class="row">
                            <label>
                              Телефон <input placeholder="+_(___)___-____" maxlength="30" id="phoneFilter" class="form-control" name="phoneFilter" value="" size="25" type="tel">
                              <input class="hide" type="checkbox" id="phone_mask" checked=true>
                              <label id="descr" class="hidden">Маска ввода</label>
                          </label>
                          <button id="submit-filter" class="btn hidden"></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="preloader"></div>

            <table class="table table-striped table-hover table-responsive">  
              <thead class="thead-grey">
                <tr>
                  <th class="hide index">index</th>
                  <th>№</th>
                  <th>Фамилия</th>
                  <th>Имя</th>
                  <th>Отчество</th>
                  <th>Дата рождения</th>
                  <th>Номер телефона</th>
                  <th>Факультет</th>
                  <th>Учебная группа</th>
                  <th>Текущее место работы: Компания</th>
                  <th>Текущее место работы: Должность</th>
                  <th>Место работы на последнем курсе: Компания</th>
                  <th>Место работы на последнем курсе: Должность</th>
                  <th>Удалить</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div id="settings" class="tab-pane">
            <select id="stageOfStudyingSelect" class="form-control" style="margin-top: 5px;">
              <option value="bach">Бакалавриат</option>
              <option value="mag">Магистратура</option>
            </select>
              <div class="row" style="margin-top: 10px;">
                <div class="col-lg-6">
                  <button id="addFacultyButton"><i class="glyphicon glyphicon-plus"></i>Добавить факультет</button>
                  <table id="faculties" class="table table-striped table-hover table-responsive">
                    <thead class="thead-grey">
                    <tr>
                      <th width="80%">Факультет</th>
                      <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <div class="col-lg-6">
                  <button id="addGroupButton"><i class="glyphicon glyphicon-plus"></i>Добавить группу</button>
                  <table id="groups" class="table table-striped table-hover table-responsive">
                    <thead class="thead-grey">
                    <tr>
                      <th width="80%">Группа</th>
                      <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div id="db-error" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Ошибка!</h4>
          </div>
          <div class="modal-body">
            <p>При загрузке данных из базы данных произошла ошибка</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="reload-base">Повторить загрузку</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="add-faculty-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Добавить факультет</h4>
          </div>
          <div class="modal-body">
            <form id="add-faculty-form" name="add-faculty-form">
              <div class="row">
                <div class="col-lg-4">Стадия обучения</div>
                <div class="col-lg-8">
                  <select id="addFacultyStageOfStudyingSelect" class="form-control" style="margin-top: 5px;">
                    <option value="bach">Бакалавриат</option>
                    <option value="mag">Магистратура</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">Наименование факультета</div>
                <div class="col-lg-8">
                  <input type="text" class="form-control" id="facultyName" name="facultyName">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="add-faculty">Добавить</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="add-group-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            <h4 class="modal-title">Добавить группу</h4>
          </div>
          <div class="modal-body">
            <form id="add-group-form" name="add-group-form">
              <div class="row">
                <div class="col-lg-4">Уровень обучения</div>
                <div class="col-lg-8">
                  <select id="addGroupStageOfStudyingSelect" name="addGroupStageOfStudyingSelect" class="form-control">
                    <option value="bach">Бакалавриат</option>
                    <option value="mag">Магистратура</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">Факультет</div>
                <div class="col-lg-8">
                  <select class="form-control" id="add-group-faculty-select" name="add-group-faculty-select"></select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  Название группы
                </div>
                <div class="col-lg-8">
                  <input type="text" class="form-control" id="groupName" name="groupName">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a class="btn btn-default" data-dismiss="modal">Закрыть</a>
            <button type="button" class="btn btn-primary" id="add-group">Добавить</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="accept-delete" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Внимание!</h4>
          </div>
          <div class="modal-body">
            <p>Вы действительно хотите удалить запись?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Не удалять</button>
            <button type="button" class="btn btn-primary" id="delete">Удалить</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="accept-delete-faculty" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Внимание!</h4>
          </div>
          <div class="modal-body">
            <p>Вы действительно хотите удалить факультет?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Не удалять</button>
            <button type="button" class="btn btn-primary" id="delete-faculty">Удалить</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="accept-delete-group" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Внимание!</h4>
          </div>
          <div class="modal-body">
            <p>Вы действительно хотите удалить группу?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Не удалять</button>
            <button type="button" class="btn btn-primary" id="delete-group">Удалить</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="successfulDeleted" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Запись удалена!</h4>
          </div>
          <div class="modal-body">
            <p>Запись успешно удалена!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Ок</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="deletedWithError" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Произошла ошибка!</h4>
          </div>
          <div class="modal-body">
            <p>При удалении записи произошла ошибка!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div>
      <div id="addWithError" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Произошла ошибка!</h4>
            </div>
            <div class="modal-body">
              <p>При записи в базу данных произошла ошибка. Пожалуйста, повторите попытку!</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <div id="previewError" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Ошибка!</h4>
          </div>
          <div class="modal-body">
            <p>При получении анкеты произошла ошибка! Возможно, запись была удалена!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div>
    <div id="preview" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <img id="previewLogo" src="/img/logo-preview.png">
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-3">Фамилия:</div>
              <div class="col-lg-3 value" id="familyName_value">

              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-lg-offset-3">Имя:</div>
              <div class="col-lg-3 value" id="firstName_value">

              </div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-lg-offset-3">Отчество:</div>
              <div class="col-lg-3 value" id="lastName_value">

              </div>
            </div>
            <div class="row" >
              <div class="col-lg-4 col-lg-offset-3">Дата рождения:</div>
              <div class="col-lg-3 value" id="birthDate_value">

              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-lg-offset-3">Уровень обучения:</div>
              <div class="col-lg-3 value" id="stageOfStudying_value">

              </div>
            </div>
            <div class="row" style="margin-top: 10px;">
              <div class="col-lg-4 col-lg-offset-3">Факультет:</div>
              <div class="col-lg-3 value" id="faculty_value">

              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-lg-offset-3">Учебная группа:</div>
              <div class="col-lg-3 value" id="group_value">

              </div>
            </div>
            <div class="row">
              <div class='col-lg-4 col-lg-offset-3'>Мобильный телефон:</div>
              <div class="col-lg-3 value" id="phone_value">

              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-lg-offset-3">E-mail:</div>
              <div class="col-lg-3 value" id="email_value">

              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-lg-offset-3">Трудоустроены в настоящее время (работаете/собираетесь приступить к работе)?</div>
              <div class="col-lg-4 value" id="haveAJobNow_value">

              </div>
              <div class="col-lg-4 col-lg-offset-3">
                <ul>
                  <li>
                    Компания: <span id="currentTimeWorkplace_value" class="value"></span>
                  </li>
                  <li>
                    Должность: <span id="currentTimePost_value" class="value"></span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-lg-offset-3">Была ли у Вас оплачиваемая работа на последнем курсе(до преддипломной практики)?</div>
              <div class="col-lg-4 value" id="hadAJobAtLastYearSt_value">

              </div>
              <div class="col-lg-4 col-lg-offset-3 form-inline">
                <ul>
                  <li>
                    Компания: <span id="lastYearStWorkplace_value" class="value"></span>
                  </li>
                  <li >
                    Должность: <span id="lastYearStPost_value" class="value"></span>
                  </li>
                </ul>
              </div>
            </div>
            <!--div class="row">
                <div for="experience" class="col-lg-4 col-lg-offset-3">Трудовой опыт:</div>
                <div class="col-lg-3" id="experience_value">

                </div>
            </div!-->
            <div class="row" id="afterStudying">
              <div class="col-lg-4 col-lg-offset-3">После получения диплома Вы:</div>
              <div class="col-lg-6 col-lg-offset-3">
                <ul>
                  <li id="hsenn_value" class="value">

                  </li>

                  <li id="hseMoscow_value" class="value">

                  </li>
                  <li id="otherHE_value" class="value">

                  </li>
                  <li>
                    <div id="goingToGetAJob_value" class="value"></div>
                    <ul>
                          <li style="list-style:none">
                            Компания: <span id="goingToGetAJobWorkplace_value" class="value"></span>

                          </li>
                          <li style="list-style:none">
                            Должность: <span id="goingToGetAJobPost_value" class="value"></span>
                          </li>
                    </ul>
                  </li>



                  <li id="otherCheckbox_value" class="value">

                  </li>
                </ul>
              </div>
            </div>
            <div class="row">
              <ul class="gifListStyle">
                <li class="col-lg-9 col-lg-offset-2 value" id="weeklyNewsletter_value">

                </li>
              </ul>
            </div>
            <div class="row italic">
              <ul class="gifListStyle">
                <li class="col-lg-9 col-lg-offset-2 value" id="savingHandlingData_value">
                </li>
              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4 col-xs-12 col-md-4 col-md-offset-4">
                <a id="print" class="btn btn-lg btn-block btn-active">Печать</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="page-to-print" class="hide">
      <div class="page-header">
        <img id="printLogo" src="/img/logo-preview.png">
      </div>
      <div id="printBody"></div>
      <div>
        <div class="row" style=" margin-top: 40px;">
          <div id="date" class="col-lg-4 col-lg-offset-3" >

          </div>
          <div class="lg-col-4" style="text-align: center; display: table-cell;">Подпись ____________________ </div>
        </div>
      </div>
    </div>
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script src="/js/jquery.inputmask.js" type="text/javascript"></script>
  <script src="/js/jquery.bind-first-0.1.min.js" type="text/javascript"></script>
  <script src="/js/jquery.inputmask-multi.js" type="text/javascript"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/jquery.chained.min.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>
  <script type="text/javascript" src="js/functions.js"></script>
  <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>