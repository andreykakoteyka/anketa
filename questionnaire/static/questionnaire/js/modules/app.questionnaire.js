angular.module("app.questionnaire", ["ngMaterial", "ngResource", "ngMask"])
    .config(function($mdDateLocaleProvider){
        $mdDateLocaleProvider.formatDate = function(date) {
            return moment(date).format('DD.MM.YYYY');
        };
        $mdDateLocaleProvider.parseDate = function(dateString) {
            var m = moment(dateString, ['DD.MM.YY', 'DD.MM.YYYY'], true);
            return m.isValid() ? m.toDate() : new Date(NaN);
        };
    });
