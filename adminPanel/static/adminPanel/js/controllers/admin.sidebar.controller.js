angular.module("admin.sidebar", ["ngMaterial"])
    .controller('AdminSidebarController', ["$scope", '$mdSidenav', '$mdMedia', '$rootScope', '$state', 'AuthService', function($scope, $mdSidenav, $mdMedia, $rootScope, $state, AuthService){
        $scope.toggleLeftMenu = function(){
            $mdSidenav('left').toggle();
        };
        $scope.menuItems = $rootScope.menuItems;
        //$scope.sidebarIsLocked = function(){
        //    return $mdMedia('gt-md');
        //}
        $scope.logout = function () {
            AuthService.logout();
        }
    }]);