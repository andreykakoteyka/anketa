'use strict';
angular.module('app.anketa').factory('AnketaService', function(){

    return {
       create: function(){
           return {
               studyStage: null,
               faculty: null

           };
       }
   }
});
