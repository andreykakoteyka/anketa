'use strict';
angular.module('app.anketa').controller('anketaController', function($scope, AnketaService){
    //$scope.normalizeBirthDate = function(){
        //$scope.anketa.bitrhday = moment($scope.anketa.bitrhday).format('DD.MM.YYYY');
    //}
    $scope.faculties = [
        {
            id:1,
            name: "BiPm",
            stage: "bach"
        },
        {
            id:2,
            name:"Ur",
            stage: 'mag'
        }
    ];

    $scope.groups = [
        {
            id: 1,
            name: "11pmi",
            faculty_id: 2

        }
    ];
    $scope.anketa = AnketaService.create();
    $scope.anketa.studyStage = 'bach';

    $scope.showPreview = function(){
        alert($scope.anketaForm.$valid);
    }

    $scope.$watch('anketa.studyStage', function(newValue){
        if(!newValue || newValue !== $scope.anketa.faculty.stage){
            $scope.anketa.faculty = null;
        }
    })
    $scope.$watch('anketa.faculty', function(newValue){
        if(!newValue || newValue.id !== $scope.anketa.group.faculty_id){
            $scope.anketa.group = null;
        }
    })
});