'use strict';
angular.module('app.questionnaire').factory('QuestionnaireService', function($http){

    return {
       create: function(){
           //use default date as current date - 20 years for usability
           //return {
           //     "firstName": "",
           //     "familyName": "",
           //     "lastName": "",
           //     "birthday": moment().add(-20, 'years').toDate(),
           //     "phone": "",
           //     "email": "",
           //     "degree": null,
           //     "hasJob": false,
           //     "currentCompany": "",
           //     "currentPost": "",
           //     "hadJobBeforePractise": false,
           //     "companyBeforePractise": "",
           //     "postBeforePractise": "",
           //     "magHseNN": false,
           //     "magHseMoscow": false,
           //     "magOtherUniversity": false,
           //     "otherUniversityName": "",
           //     "changeJob": false,
           //     "changeJobCompany": "",
           //     "changeJobPost": "",
           //     "getJob": false,
           //     "getJobCompany": "",
           //     "getJobPost": "",
           //     "other": false,
           //     "otherText": "",
           //     "agreeMail": false,
           //     "agreePersonalData": false,
           //     "faculty": null,
           //     "group": null
           // };

           return {
                "firstName": "фывфыв",
                "familyName": "фывфыв",
                "lastName": "",
                "birthday": moment().add(-20, 'years').toDate(),
                "phone": "+7(987) 743 90-10",
                "email": "admin@mail.ru",
                "degree": null,
                "hasJob": false,
                "currentCompany": "",
                "currentPost": "",
                "hadJobBeforePractise": false,
                "companyBeforePractise": "",
                "postBeforePractise": "",
                "magHseNN": false,
                "magHseMoscow": false,
                "magOtherUniversity": false,
                "otherUniversityName": "",
                "changeJob": false,
                "changeJobCompany": "",
                "changeJobPost": "",
                "getJob": false,
                "getJobCompany": "",
                "getJobPost": "",
                "other": false,
                "otherText": "",
                "agreeMail": false,
                "agreePersonalData": true,
                "faculty": null,
                "group": null
            };


       },
       save: function(questionnaire){
           return $http.post('/core/questionnaires/', questionnaire);
       }
   }
});
