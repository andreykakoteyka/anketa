'use strict';
angular.module('app.preview', ["ngMaterial"])
    .controller('PreviewController', function($scope, $mdDialog, QuestionnaireService){
    var self = this;


    $scope.anketa = self.anketa;

    $scope.closePreview = function () {
        $mdDialog.hide();
    };

    $scope.save = function () {
        var anketa = {};
        angular.extend(anketa, $scope.anketa);
        //prepare anketa for post request
        anketa.faculty = anketa.faculty.id;
        anketa.group = anketa.group.id;
        //django needs this format
        anketa.birthday = moment(anketa.birthday).format("YYYY-MM-DD");
        QuestionnaireService.save(anketa)
            .then(
                function () {
                    $mdDialog.show({
                        templateUrl:"/static/questionnaire/js/modals/success/view.html",
                        controller: "SuccessController",
                        parent: angular.element(document.querySelector(".content")),
                        clickOutsideToClose: false,
                        fullscreen: true
                    });
                },
                function () {
                    var confirm = $mdDialog.confirm()
                          .title('Ошибка!')
                          .textContent('Произошла ошибка, пожалуйста повторите действие!')
                          .parent(angular.element(document.querySelector(".content")))
                          .ariaLabel('Error')
                          .targetEvent($scope.$event)
                          .ok('Повторить')
                          .cancel('Отмена');


                    angular.extend(confirm, {
                        disableParentScroll: true
                    });

                    $mdDialog.show(confirm).then(function(){
                            $scope.save();
                        }
                      )
                }
            );
    }
});