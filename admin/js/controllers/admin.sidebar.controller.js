angular.module("admin.sidebar", ["ngMaterial"])
    .controller('AdminSidebarController', ["$scope", '$mdSidenav', '$mdMedia', '$rootScope', function($scope, $mdSidenav, $mdMedia, $rootScope){
        $scope.toggleLeftMenu = function(){
            $mdSidenav('left').toggle();
        };
        $scope.menuItems = $rootScope.menuItems;
        //$scope.sidebarIsLocked = function(){
        //    return $mdMedia('gt-md');
        //}
    }]);