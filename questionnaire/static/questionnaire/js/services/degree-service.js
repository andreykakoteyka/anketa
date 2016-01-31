/**
 * Created by aigoshin on 1/26/16.
 */
'use strict';
angular.module('app.degrees', ["ngResource"])
    .factory('DegreeService', function ($resource) {
        var resource = $resource('/core/degrees/', {}, {
                get : {method : 'GET', isArray: true}
            });
        return {
            getDegrees: function(){
                return resource.get().$promise;
            }
        }
    });