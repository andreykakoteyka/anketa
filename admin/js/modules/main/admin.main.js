angular.module('admin.main', ['ngMaterial'])
    .controller('AdminMainController', ['$scope', '$mdSidenav', '$rootScope', function($scope, $mdSidenav, $rootScope){

        $scope.openLeftMenu = function(){
            $mdSidenav('left').toggle();
        };

        $scope.menuItems = $rootScope.menuItems;
    }]);
