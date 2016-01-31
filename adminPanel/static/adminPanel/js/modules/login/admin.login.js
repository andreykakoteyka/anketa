angular.module('admin.login', ['ngMaterial'])
    .controller('AdminLoginController', ["$mdDialog", function($mdDialog){
        $mdDialog.show({
          controller: "LoginDialogController",
          templateUrl: '/static/adminPanel/js/modules/login/view.html',
          parent: angular.element(document.body),
          clickOutsideToClose: false,
          fullscreen: false
        });
    }])
    .controller("LoginDialogController", ["$scope", "AuthService", function($scope, AuthService){
        $scope.user ={
            username: '',
            password: ''
        };

        $scope.login = function () {

            AuthService.login($scope.user)
                .catch(function(response){
                    if (response.status == 301){
                        window.location = "/admin";
                    }
                    $scope.user.password = '';
                });
        }
    }]);