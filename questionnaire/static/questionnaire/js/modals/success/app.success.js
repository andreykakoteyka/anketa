/**
 * Created by aigoshin on 1/28/16.
 */
'use strict';
angular.module("app.success", ["ngMaterial","AngularPrint"])
    .controller('SuccessController', function($scope, $mdDialog){

        $scope.close = function () {
            $mdDialog.hide();
        }
    });