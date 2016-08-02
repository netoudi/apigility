angular.module('starter.controllers', [])

  .controller('LoginCtrl', [
    '$scope', '$http', '$state', 'OAuth',
    function ($scope, $http, $state, OAuth) {
      $scope.login = function (data) {
        OAuth.getAccessToken(data)
          .then(function (data) {
            $state.go('tabs.orders');
          }, function (error) {
            $scope.error_login = 'Username or password is invalid.'
          });
      }
    }
  ])

;
