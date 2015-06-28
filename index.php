<!DOCTYPE html>
<html>
<head>
	<title>Анкета для выпускника ВШЭ НН</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="plug-ins/PickMeUp-master/css/pickmeup.min.css">
</head>
<body>
	<header>
		<div class="fullscreen">
            <img id="logo" src="img/logo.jpg"/>
            <div id="arrow">
                <img src="img/arrow.png"/>
            </div>
        </div>
	</header>
	<div class="container" id="body">
		<form id='anketa' name='anketa' type='post'>

			<div class="row">
                <label for="familyName" class="col-lg-4 col-lg-offset-3">Фамилия:</label>
                <div class="col-lg-3 form-group">
                    <input id="familyName" name="familyName" class="name form-control" type="text" onkeyup="validateFamilyName(); checkAnswers(true)" />
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                </div>
			</div>
            <div class="row">
                <label for="firstName" class="col-lg-4 col-lg-offset-3">Имя:</label>
                <div class="col-lg-3 form-group">
                    <input id="firstName" name="firstName" class="name form-control" type="text" onkeyup="validateFirstName(); checkAnswers(true);"/>
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                </div>
            </div>
			<div class="row">
                <label for="lastName" class="col-lg-4 col-lg-offset-3">Отчество:</label>
                <div class="col-lg-3 form-group">
                    <input id="lastName" name="lastName" class="name form-control" type="text" onkeyup="validateLastName(); checkAnswers(true);" />
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                </div>
			</div>
			<div class="row" >
				<label for="birthDate" class="col-lg-4 col-lg-offset-3">Дата рождения:</label>
				<div class="col-lg-3 form-group">
                	<input id="birthDate" name="birthDate" class="datepicker form-control" onkeydown="return false;" type="text" onblur="validateBirthDate(); checkAnswers(true);" >
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
				</div>
            </div>
			<div class="row">
					<label for="stageOfStudyingSelect" class="col-lg-4 col-lg-offset-3">Уровень обучения:</label>
					<div class="col-lg-3">
						<label style="margin-top: 5px;"><input type="radio" class="stageOfStudying" name="stageOfStudying" value=bach checked=true /><span>Бакалавриат</span></label>
						<label style="margin-top: 5px;"><input type="radio" class="stageOfStudying" name="stageOfStudying" value=mag /><span>Магистратура</span></label>
					</div>
                    <select id="stageOfStudyingSelect" class="hide">
                        <option value="bach">Бакалавриат</option>
                        <option value="mag">Магистратура</option>
				    </select>
			</div>
			<div class="row" style="margin-top: 10px;">
                <label for="faculty" class="col-lg-4 col-lg-offset-3">Факультет:</label>
                <div class="col-lg-3">
                    <select id="faculty" name="faculty" class="form-control">
                    </select>
                </div>	
			</div>
			<div class="row">
				<label for="group" class="col-lg-4 col-lg-offset-3">Учебная группа:</label>
                <div class="col-lg-3">
                    <select id="group" name="group" class="form-control">
                    </select>
                </div>
			</div>
			<div class="row">
				<label for="phone" class='col-lg-4 col-lg-offset-3'>Мобильный телефон:</label>
					<div class="col-lg-3 form-group">
						<input placeholder="+_(___)___-____" maxlength="30" onKeyUp="validateMobilePhone(); checkAnswers(true);" id="phone" class="form-control" value="7" name="phone" size="25" type="tel"><br>
                        <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <input class="hide" type="checkbox" id="phone_mask" checked=true>
                        <label id="descr">Маска ввода</label>
                     <!---div>
                         <label  for="dontHavePhone"><input type="checkbox" id="dontHavePhone" style="float:left;"> У меня нет мобильного телефона</label>
                 	</div--->
					</div><br>
                   
				

			</div>
			<div class="row">
                <label for="email" class="col-lg-4 col-lg-offset-3">E-mail:</label>
                <div class="col-lg-3 form-group">
                    <input type="email" id="email" onKeyUp="validateEmail(); checkAnswers(true);" name="email"  class="form-control"/>
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                </div>
			</div>
			<div class="row">
				<label for="haveAJobNow" class="col-lg-4 col-lg-offset-3">Трудоустроены в настоящее время (работаете/собираетесь приступить к работе)?</label>
				<div class="col-lg-4">
					<label><input type="radio" value='Да' name="haveAJobNow" /><span> Да</span></label>
					<label><input type="radio" checked='' value='Нет' name="haveAJobNow" /><span> Нет</span></label>
				</div>
                <div class="col-lg-4 col-lg-offset-3 form-inline" id="currentTimeJob">
                    <ul>
                        <li><label for="currentTimeWorkplace">Компания: </label><input type="text" class="form-control" id="currentTimeWorkplace" name="currentTimeWorkplace" /></li>
                        <li><label for="currentTimePost">Должность: </label><input  type="text" class="form-control" id="currentTimePost" name="currentTimePost" style="margin-top:5px;" /></li>
                    </ul>
                </div>
			</div>

			<div id="hadAJobBeforeOutRow" class="row">
				<label for="hadAJobAtLastYearSt" class="col-lg-4 col-lg-offset-3">Была ли у Вас оплачиваемая работа на последнем курсе(до преддипломной практики)?</label>
				<div class="col-lg-4">
					<label><input type="radio" value='Да' name="hadAJobAtLastYearSt" /><span> Да</span></label>
					<label><input type="radio" checked='' value='Нет' name="hadAJobAtLastYearSt" /><span> Нет</span></label>
				</div>
				<div class="col-lg-4 col-lg-offset-3 form-inline" id="lastYearStJob">
                    <ul>
                        <li><label for="LastYearStWorkplace">Компания: </label><input type="text" class="form-control" id="LastYearStWorkplace" name="lastYearStWorkplace" /></li>
                        <li><label for="LastYearStPost">Должность: </label><input  type="text" class="form-control" id="lastYearStPost" name="lastYearStPost" style="margin-top:5px;" /></li>
                    </ul>
				</div>
			</div>
			<!--div class="row">
                <label for="experience" class="col-lg-4 col-lg-offset-3">Трудовой опыт:</label>
                <div class="col-lg-3">
                    <input type="text" id="experience" name="experience" class="form-control"/>
                </div>
			</div!-->
			<div class="row">
				<div class="col-lg-4 col-lg-offset-3">После получения диплома Вы:</div>
				<div class="col-lg-6 col-lg-offset-3">
					<ul style="list-style: none;">
						<li>
                            <label for="hsenn">
                                <input type="checkbox" class="afterGraduate" id="hsenn" name="hsenn" />
                                планируете поступать в магистратуру НИУ ВШЭ-НН
                            </label>
                        </li>
					
                        <li>
                            <label for="hseMoscow">
                                <input type="checkbox" class="afterGraduate" id="hseMoscow" name="hseMoscow" />
                                планируете поступать в магистратуру НИУ ВШЭ-Москва
                            </label>
                        </li>
                        <li>
                            <label for="otherHE">
                                <input type="checkbox" class="afterGraduate" id="otherHE" name="otherHE" />
                                планируете поступать в магистратуру другого ВУЗа(укажите какого)
                            </label>
                            <div>
                                <input type="text" id="otherHEInput" name="otherHEInput" class="form-control appendix"/>
                            </div>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" class="afterGraduate" id="goingToGetAJob" name="goingToGetAJob" />
                                планируете трудоустроиться
                            </label>
                            <div>
                                <ul>
                                    <li><label for="LastYearStWorkplace">Компания: </label><input type="text" class="form-control" id="goingToGetAJobWorkplace" name="goingToGetAJobWorkplace" /></li>
                                    <li><label for="LastYearStPost">Должность: </label><input  type="text" class="form-control" id="goingToGetAJobPost" name="goingToGetAJobPost" style="margin-top:5px;" /></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <label  for="otherCheckbox">
                                <input type="checkbox" class="afterGraduate" id='otherCheckbox' name="otherCheckbox"/>
                                Другое(укажите свой вариант)
                            </label>
                            <div>
                                <input type="text" id="otherCheckboxInput" name="otherCheckboxInput" class="form-control appendix"/>
                            </div>
                        </li>
                    </ul>
				</div>
			</div>
			<div class="row">
                <div class="col-lg-7 col-lg-offset-3">
					<label for="weeklyNewsletter"><input type="checkbox" id="weeklyNewsletter" name="weeklyNewsletter">Я заинтересован(-а) в получении еженедельной рассылки от Отдела развития карьеры НИУ ВШЭ - Нижний Новгород о вакансиях и мероприятиях в cфере карьеры</label>
                </div>
			</div>
			<div class="row italic">				
					<label class="col-lg-7 col-lg-offset-3"><input type="checkbox" id="savingHandlingData" name="savingHandlingData" style="float:left;"> Я согласен(-на) на обработку и использование моих персональных данных в целях мониторинга трудоустройства и координации взаимодействия с выпускниками НИУ ВШЭ. Данное согласие может быть отозвано мною письменным заявлением в случае неправомерного использования предоставленных данных.</label>
            </div>
			<div class="footer container" style="height: 80px;">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-xs-12 col-md-4 col-md-offset-4">
                        <a id="showPreview" class="btn btn-lg btn-block btn-active">Предварительный просмотр</a>
                    </div>
                </div>
			</div>
		</form>
	</div>
    <div id="preview" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <img id="previewLogo" src="img/logo-preview.png">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">Фамилия:</div>
                    <div class="col-lg-3" id="familyNamePreview">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">Имя:</div>
                    <div class="col-lg-3" id="firstNamePreview">

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">Отчество:</div>
                    <div class="col-lg-3" id="lastNamePreview">

                    </div>
                </div>
                <div class="row" >
                    <div class="col-lg-4 col-lg-offset-3">Дата рождения:</div>
                    <div class="col-lg-3" id="birthDatePreview">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">Уровень обучения:</div>
                    <div class="col-lg-3" id="stageOfStudyingPreview">

                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-lg-4 col-lg-offset-3">Факультет:</div>
                    <div class="col-lg-3" id="facultyPreview">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">Учебная группа:</div>
                    <div class="col-lg-3" id="groupPreview">

                    </div>
                </div>
                <div class="row">
                    <div class='col-lg-4 col-lg-offset-3'>Мобильный телефон:</div>
                    <div class="col-lg-3" id="phonePreview">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">E-mail:</div>
                    <div class="col-lg-3" id="emailPreview">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">Трудоустроены в настоящее время (работаете/собираетесь приступить к работе)?</div>
                    <div class="col-lg-4" id="haveAJobNowPreview">

                    </div>
                    <div class="col-lg-4 col-lg-offset-3">
                        <ul>
                            <li>
                                Компания: <span id="currentTimeWorkplacePreview"></span>
                            </li>
                            <li>
                                Должность: <span id="currentTimePostPreview"></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">Была ли у Вас оплачиваемая работа на последнем курсе(до преддипломной практики)?</div>
                    <div class="col-lg-4" id="hadAJobAtLastYearStPreview">

                    </div>
                    <div class="col-lg-4 col-lg-offset-3 form-inline">
                        <ul>
                            <li>
                                Компания: <span id="lastYearStWorkplacePreview"></span>
                            </li>
                            <li >
                                Должность: <span id="lastYearStPostPreview"></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--div class="row">
                    <div for="experience" class="col-lg-4 col-lg-offset-3">Трудовой опыт:</div>
                    <div class="col-lg-3" id="experiencePreview">

                    </div>
                </div!-->
                <div class="row" id="afterStudyingPreview">
                    <div class="col-lg-4 col-lg-offset-3">После получения диплома Вы:</div>
                    <div class="col-lg-6 col-lg-offset-3">
                        <ul>
                            <li id="hsennPreview">

                            </li>

                            <li id="hseMoscowPreview">

                            </li>
                            <li id="otherHEPreview">

                            </li>
                            <li>
                                <div id="goingToGetAJobPreview"></div>
                                <ul>
                                    <li style="list-style:none">
                                        Компания: <span id="goingToGetAJobWorkplacePreview"></span>

                                    </li>
                                    <li style="list-style:none">
                                        Должность: <span id="goingToGetAJobPostPreview"></span>
                                    </li>
                                </ul>
                            </li>
                            <li id="otherCheckboxPreview">

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <ul class="gifListStyle">
                        <li class="col-lg-9 col-lg-offset-2" id="weeklyNewsletterPreview">

                        </li>
                    </ul>
                </div>
                <div class="row italic">
                    <ul class="gifListStyle">
                        <li class="col-lg-9 col-lg-offset-2" id="savingHandlingDataPreview">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-xs-12 col-md-4 col-md-offset-4">
                        <a id="accept" class="btn btn-lg btn-block btn-active"><img src="img/preloader.png" class="preloader">Подтвердить</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div id="error" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h2>Ошибка</h2></div>
                <div class="modal-body">
                    <h5>Произошел сбой работы с базой данных!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-active" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <div id="warning" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h2>Внимание</h2></div>
                <div class="modal-body">
                    <h5>Перед подтверждением вы должны согласиться на обработку данных!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-active" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <div id="finishModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h3>Ваши данные успешно добавлены в базу!</h3></div>
                <div class="modal-body">
                    <h5>Спасибо! Ваши данные успешно внесены в базу выпускников НИУ ВШЭ – Нижний Новгород.Пожалуйста, распечатайте и подпишите анкету. Подписанную Вами анкету передайте в отдел развития карьеры НИУ ВШЭ – Нижний Новгород (Б.Печерская, 25/12, к.308), где Вы получите необходимую отметку в обходном листе. </h5>
                </div>
                <div class="modal-footer">
                    <a id="print" class="btn btn-active"> Печать</a>
                    <!--a id="saveAsDocument" class="btn btn-active"> Сохранить в документ</a!-->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <div id="page-to-print" class="hide">
        <div class="page-header">
            <img id="printLogo" src="img/logo-preview.png">
        </div>
        <div id="printBody"></div>
        <div>
            <div class="row" style=" margin-top: 40px;">
                <div id="currentDate" class="col-lg-4 col-lg-offset-3" >

                </div>
                <div class="lg-col-4" style="text-align: center; display: table-cell;">Подпись ____________________ </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="js/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/jquery.bind-first-0.1.min.js" type="text/javascript"></script>
<script src="js/jquery.inputmask-multi.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.color.js"></script>
<script type="text/javascript" src="js/jquery.inputmask-multi.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.chained.min.js"></script>
<script type="text/javascript" src="plug-ins/PickMeUp-master/js/jquery.pickmeup.min.js"></script>
<script type="text/javascript" src="plug-ins/jsPDF-master/dist/jspdf.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</html>