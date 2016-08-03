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

  .controller('OrdersCtrl', [
    '$scope', '$http', '$state', 'OAuthToken',
    function ($scope, $http, $state, OAuthToken) {
      $scope.getOrders = function () {
        $http.get('http://localhost:8888/orders')
          .then(function (data) {
            $scope.orders = data.data._embedded.orders;
          });
      };

      $scope.onOrderDelete = function (order) {
        $http.delete('http://localhost:8888/orders/' + order.id)
          .then(function (data) {
            $scope.getOrders();
          }, function (error) {
            console.log(error);
          });
      };

      $scope.doRefresh = function () {
        $scope.getOrders();
        $scope.$broadcast('scroll.refreshComplete')
      }

      $scope.getOrders();
    }
  ])

;
