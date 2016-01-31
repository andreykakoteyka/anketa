/**
 * Created by aigoshin on 1/24/16.
 */
'use strict';
angular.module('app.faculties', ["ngResource"])
    .factory('FacultyService', function ($resource) {
        var resource = $resource('/core/faculties/', {}, {
                get : {method : 'GET', isArray: true}
            });
        return {
            getFaculties: function(){
                return resource.get().$promise;
            }
        }
    });