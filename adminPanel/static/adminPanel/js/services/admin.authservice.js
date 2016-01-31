'use strict';
angular.module('admin.authservice', ['ngResource'])
    .factory('AuthService', function($resource){

        var resource = $resource('/admin/auth/login', {}, {
            login: {method: 'POST'},
            logout:{url: '/admin/auth/logout', method: 'GET'}
        });

        return {
            login: function(user){
                return resource.login(user).$promise;
            },
            logout: function(){
                resource.logout().$promise;
            }
        }
    });
