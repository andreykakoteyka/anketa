'use strict';
angular.module('app.questionnaire').controller('QuestionnaireController', function($scope, $timeout, $mdDialog, $mdToast, QuestionnaireService, GroupService, FacultyService, DegreeService){

    $scope.anketa = QuestionnaireService.create();
    DegreeService.getDegrees()
        .then(function(data){
            $scope.degrees = data;
            $scope.anketa.degree = data[0].value;
        });
    FacultyService.getFaculties()
        .then(function(data){
            $scope.faculties = data;
        });

    GroupService.getGroups()
        .then(function(data){
            $scope.groups = data;
        });

    /*toast position*/
    var last = {
      bottom: true,
      top: false,
      left: false,
      right: true
    };
    var toastPosition = angular.extend({},last);
    var getToastPosition = function() {
        sanitizePosition();
        return Object.keys(toastPosition)
            .filter(function(pos) { return toastPosition[pos]; })
            .join(' ');
    };
    function sanitizePosition() {
        var current = toastPosition;
        if ( current.bottom && last.top ) current.top = false;
        if ( current.top && last.bottom ) current.bottom = false;
        if ( current.right && last.left ) current.left = false;
        if ( current.left && last.right ) current.right = false;
        last = angular.extend({},current);
    }
    /* toast position end*/
    $scope.showPreview = function(e){
        var delay = 0;
        if (!$scope.anketa.agreePersonalData){
            $mdToast.show(
              $mdToast.simple()
                .content('Нет согласия на обработку персональных данных!')
                .position(getToastPosition())
                .parent(angular.element(document.querySelector(".content")))
                .hideDelay(3000)
            );
            delay += 3000;
        }

        if($scope.anketaForm.$valid){
            $mdDialog.show({
              locals: {anketa: $scope.anketa},
              bindToController: true,
              controller: "PreviewController",
              templateUrl: '/static/questionnaire/js/modals/preview/view.html',
              parent: angular.element(document.body),
              targetEvent: e,
              clickOutsideToClose: true,
              fullscreen: true
            });
        } else{
            $timeout(function () {
                $mdToast.show(
                  $mdToast.simple()
                    .content('Анкета заполнена неверно или не полностью!')
                    .position(getToastPosition())
                    .parent(angular.element(document.querySelector(".content")))
                    .hideDelay(3000)
                );
            },
            delay);

        }
    };

    $scope.$watch('anketa.degree', function(newValue){
        if($scope.anketa.faculty && (!newValue || !$scope.anketa.faculty.degree || newValue !== $scope.anketa.faculty.degree) ){
            $scope.anketa.faculty = null;
        }
    });
    $scope.$watch('anketa.faculty', function(newValue){
        if($scope.anketa.group && (!newValue || newValue.id != $scope.anketa.group.faculty) ){
            $scope.anketa.group = null;
        }
    })
});