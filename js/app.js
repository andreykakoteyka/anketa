var dependencies = [
    "ngMaterial",
    "app.anketa"
];

angular.module('app', dependencies).config([
    '$locationProvider', '$mdThemingProvider', '$mdIconProvider',
    function($locationProvider, $mdThemingProvider, $mdIconProvider) {

        $mdThemingProvider.theme('default')
            .primaryPalette('indigo')
            .accentPalette('red');

        // Register the user `avatar` icons
        $mdIconProvider
            .icon('brand'      , '../img/brand.svg'       , 100);
    }
]);