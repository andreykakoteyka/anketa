var dependencies = [
    "ngMaterial",
    "ngResource",
    "ngMask",
    "app.questionnaire",
    "app.degrees",
    "app.faculties",
    "app.groups",
    "app.preview",
    "app.success",
    "AngularPrint"
];

angular.module('app', dependencies).config([
    '$locationProvider', '$mdThemingProvider', '$mdIconProvider', '$interpolateProvider',
    function($locationProvider, $mdThemingProvider, $mdIconProvider, $interpolateProvider) {

        $mdThemingProvider.theme('default')
            .primaryPalette('indigo')
            .accentPalette('red', {
                "default": "A700"
            });

        // Register the user `avatar` icons
        $mdIconProvider
            .icon('brand', 'static/questionnaire/img/brand.svg', 100);

        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

    }

]);