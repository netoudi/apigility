angular.module('starter.controllers', [])

  .controller('LoginCtrl', [
    '$scope', '$http', '$state',
    function ($scope, $http, $state) {
      $scope.login = function (data) {
        var dataPost = {
          grant_type: 'password',
          client_id: 'testclient',
          client_secret: 'testpass',
          username: data.username,
          password: data.password
        };

        $http.post('http://localhost:8888/oauth', dataPost)
          .success(function (data) {
            localStorage.setItem('order_token', data.access_token);
            localStorage.setItem('order_refresh_token', data.refresh_token);
            $state.go('tabs.orders');
          })
          .error(function (error) {
            $scope.error_login = 'Username or password is invalid.'
          });
      }
    }
  ])

;
