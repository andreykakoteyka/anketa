<div ng-app="app.anketa" flex class="anketa" ng-controller="anketaController">
    <form novalidate name="anketaForm" class="form" layout="column" ng-cloak>
        <md-content layout="row" layout-sm="column"  layout-align-gt-sm="space-around">
            <md-input-container flex-gt-sm="33">
                <label>Фамилия: </label>
                <input name="familyName" ng-model="anketa.familytName" minlength="2" required>
            </md-input-container>
            <md-input-container flex-gt-sm="33">
                <label>Имя: </label>
                <input name="firstName" ng-model="anketa.firstName"  minlength="2" required>
            </md-input-container>
            <md-input-container flex-gt-sm="33">
                <label>Отчество: </label>
                <input name="lastName" ng-model="anketa.lastName">
            </md-input-container>
        </md-content>
        <md-content layout="row" layout-sm="column" layout-align-sm="space-around" ng-cloak>
            <div layout="column" layout-sm="row" flex="33">
                <md-datepicker datatype="date" name="birthday" ng-model="anketa.birthday" md-placeholder="Дата рождения"></md-datepicker>
                <div class="validation-messages" ng-hide="!anketaForm.birthday.$touched" ng-messages="anketaForm.birthday.$error">
                    <div ng-message="required">Необходимо ввести дату рождения!</div>
                </div>
            </div>
            <div flex-gt-sm="66" layout="row" layout-align="start center">
                <label>Уровень обучения: </label>
                <md-radio-group ng-model="anketa.studyStage" layout="row" >
                    <md-radio-button value="bach" class="md-primary">Бакалавриат</md-radio-button>
                    <md-radio-button value="mag" class="md-primary">Магистратура</md-radio-button>
                </md-radio-group>
            </div>
        </md-content>
        <md-content layout='row' layout-sm='column'>
            <md-input-container flex-gt-sm="50">
                <label>Факультет</label>
                <md-select ng-model="anketa.faculty" ng-required=true>
                    <md-option ng-repeat="faculty in faculties | filter: {stage: anketa.studyStage}" value="{{faculty.id}}">
                        {{faculty.name}}
                    </md-option>
                </md-select>
            </md-input-container>
            <md-input-container flex-gt-sm="50">
                <label>Группа</label>
                <md-select ng-model="anketa.group" ng-required=true>
                    <md-option ng-repeat="group in groups | filter:{faculty_id: anketa.faculty}" value="{{group.id}}">
                        {{group.name}}
                    </md-option>
                </md-select>
            </md-input-container>
        </md-content>
        <md-content layout='row' layout-sm='column'>
            <md-input-container flex-gt-sm="50" required>
                <label>Мобильный телефон: </label>
                <input type="tel" ng-model="anketa.phone">
            </md-input-container>
            <md-input-container flex-gt-sm="50">
                <label>Email: </label>
                <input type="email" required ng-model="anketa.email">
            </md-input-container>
        </md-content>
        <md-content layout='row' layout-sm='column' style="overflow: hidden">
            <div layout="column" flex-gt-sm="50">
                <div layout="row"  layout-align="start center">
                    <label>Трудоустроены в настоящее время (работаете/собираетесь приступить к работе)?</label>
                    <md-switch class="md-primary" ng-model="anketa.hasJob" aria-label="Has Job Now">
                        {{anketa.hasJob? 'Да': 'Нет' }}
                    </md-switch>
                </div>
                <md-content layout="column" ng-if="anketa.hasJob">
                    <md-input-container layout="column">
                        <label>Компания: </label>
                        <input type="text" ng-model="anketa.currentCompany">
                    </md-input-container>
                    <md-input-container layout="column">
                        <label>Должость: </label>
                        <input type="text" ng-model="anketa.currentPost">
                    </md-input-container>
                </md-content>
            </div>
            <div layout="column" flex-gt-sm="50">
                <div layout="row" layout-align="start center">
                    <label>Была ли у Вас оплачиваемая работа на последнем курсе(до преддипломной практики)?</label>
                    <md-switch class="md-primary" ng-model="anketa.hadJobBeforePractics" aria-label="Has Job Now">
                        {{anketa.hadJobBeforePractics? 'Да': 'Нет' }}
                    </md-switch>
                </div>
                <md-content layout="column" ng-if="anketa.hadJobBeforePractics">
                    <md-input-container layout="column">
                        <label>Компания: </label>
                        <input type="text" ng-model="anketa.companyBeforePractics">
                    </md-input-container>
                    <md-input-container layout="column">
                        <label>Должость: </label>
                        <input type="text" ng-model="anketa.postBeforePractics">
                    </md-input-container>
                </md-content>
            </div>
        </md-content>
        <div layout="column">
           <md-toolbar class="md-title md-primary" align="center" layout-align="center">
                После получения диплома Вы:
           </md-toolbar>
            <div layout="column" flex-offset="5" class="md-body-1">
                <md-checkbox class="md-primary"ng-model="anketa.magHseNN">
                    Планируете поступать в магистратуру НИУ ВШЭ НН
                </md-checkbox>
                <md-checkbox class="md-primary"ng-model="anketa.magHseMoscow">
                    планируете поступать в магистратуру НИУ ВШЭ - Москва
                </md-checkbox>
                <div layout="column">
                    <md-checkbox class="md-primary"ng-model="anketa.magOtherUniversity">
                        планируете поступать в магистратуру другого ВУЗа(укажите какого)
                    </md-checkbox>
                    <md-content ng-if="anketa.magOtherUniversity">
                        <md-input-container layout="column">
                            <label>ВУЗ: </label>
                            <input type="text" ng-model="anketa.otherUniversityName">
                        </md-input-container>
                    </md-content>
                </div>
                <div layout="column">
                    <md-checkbox class="md-primary"ng-model="anketa.changeJob">
                        Планируете сменить работу
                    </md-checkbox>
                    <md-content layout="column" ng-if="anketa.changeJob">
                        <md-input-container layout="column">
                            <label>Компания: </label>
                            <input type="text" ng-model="anketa.changeJobCompany">
                        </md-input-container>
                        <md-input-container layout="column">
                            <label>Должость: </label>
                            <input type="text" ng-model="anketa.changeJobPost">
                        </md-input-container>
                    </md-content>
                </div>
                <div layout="column">

                    <md-checkbox class="md-primary" ng-model="anketa.getJob">
                        Планируете трудоустроиться
                    </md-checkbox>
                    <md-content layout="column" ng-if="anketa.getJob">
                        <md-input-container layout="column">
                            <label>Компания: </label>
                            <input type="text" ng-model="anketa.getJobCompany">
                        </md-input-container>
                        <md-input-container layout="column">
                            <label>Должость: </label>
                            <input type="text" ng-model="anketa.getJobPost">
                        </md-input-container>
                    </md-content>
                </div>
                <div layout="column">
                    <md-checkbox class="md-primary" ng-model="anketa.other">
                        Другое(укажите свой вариант)
                    </md-checkbox>
                    <md-content ng-if="anketa.other">
                        <md-input-container layout="column">
                            <label>Свой вариант: </label>
                            <input type="text" ng-model="anketa.otherText">
                        </md-input-container>
                    </md-content>
                </div>
            </div>
            <div layout="column">
                <md-checkbox class="md-primary" ng-model="anketa.agreeMail">
                    Я заинтересован(-а) в получении еженедельной рассылки от Отдела развития карьеры НИУ ВШЭ - Нижний Новгород о вакансиях и мероприятиях в cфере карьеры
                </md-checkbox>
                <md-checkbox class="md-primary" ng-model="anketa.agreePersonalData" required>
                    Я согласен(-на) на обработку и использование моих персональных данных в целях мониторинга трудоустройства и координации взаимодействия с выпускниками НИУ ВШЭ. Данное согласие может быть отозвано мною письменным заявлением в случае неправомерного использования предоставленных данных.
                </md-checkbox>
            </div>
            <div layout="row" layout-align="center center">
                <md-button class="md-raised" ng-class="{'md-primary' : anketaForm.$valid, 'md-warn': anketaForm.$invalid}" ng-click="showPreview()">Предварительный просмотр</md-button>
            </div>
        </div>
    </form>

</div>

