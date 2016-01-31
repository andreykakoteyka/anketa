/**
 * Created by aigoshin on 1/24/16.
 */
'use strict';
angular.module('app.groups', ["ngResource"])
    .factory('GroupService', function ($resource) {
        var resource = $resource('/core/groups/', {}, {
                get : {method : 'GET', isArray: true}
            });
        return {
            getGroups: function(){
                return resource.get().$promise;
            }
        }
    });