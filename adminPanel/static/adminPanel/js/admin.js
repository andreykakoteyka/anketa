var dependencies =[
    'ui.router',
    'ngMaterial',
    'admin.sidebar',
    'admin.main',
    'admin.db',
    'admin.management',
    'admin.settings',
    'admin.login',
    'admin.authservice'
];
angular.module('admin', dependencies)
    .config(['$locationProvider', '$mdThemingProvider', '$mdIconProvider', '$stateProvider', '$urlRouterProvider', '$interpolateProvider', function($locationProvider, $mdThemingProvider, $mdIconProvider, $stateProvider, $urlRouterProvider, $interpolateProvider) {

        $mdThemingProvider.theme('default')
            .primaryPalette('indigo')
            .accentPalette('red');

        // Register the user `avatar` icons
        $mdIconProvider
            .icon('brand'      , '/static/adminPanel/img/brand.svg'       , 100);

        $stateProvider
            .state('main',{
                url: "/main",
                templateUrl: "/static/adminPanel/js/modules/main/view.html",
                controller: 'AdminMainController'
            })
            .state('db',{
                url: "/db",
                templateUrl: "/static/adminPanel/js/modules/db/view.html",
                controller: 'AdminDBController'
            })
            .state('management',{
                url: "/management",
                templateUrl: "/static/adminPanel/js/modules/management/view.html",
                controller: 'AdminManagementController'
            })
            .state('settings',{
                url: "/settings",
                templateUrl: "/static/adminPanel/js/modules/settings/view.html",
                controller: 'AdminSettingsController'
            });

        $urlRouterProvider.otherwise("/main");

        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

    }])
    .run(["$mdSidenav", "$rootScope", "$state", function($mdSidenav, $rootScope, $state){
        $rootScope.menuItems = [
            {
                name: "Основная",
                icon: 'home',
                state: 'main',
                href: '#/main',
                description: ''
            },
            {
                name: "База",
                icon: 'storage',
                state: 'db',
                href: '#/db',
                description: ''
            },
            {
                name: "Управление",
                icon: 'developer_board',
                state: 'management',
                href: '#/management',
                description: ''
            },
            {
                name: "Настройки",
                icon: 'settings',
                state: 'settings',
                href: '#/settings',
                description: ''
            }
        ];
    }])
    .controller('AppController', ['$scope', '$mdSidenav', '$rootScope', function($scope, $mdSidenav, $rootScope){
        $scope.toggleLeftMenu = function(){
            $mdSidenav('left').toggle();
        };

    }]);