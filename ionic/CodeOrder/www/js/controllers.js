angular.module('starter.controllers', [])

  .controller('LoginCtrl', [
    '$rootScope', '$scope', '$http', '$state', 'OAuth',
    function ($rootScope, $scope, $http, $state, OAuth) {
      if (!$rootScope.error_login) {
        $scope.error_login = $rootScope.error_login;
        $rootScope.error_login = null;
      }

      $scope.login = function (data) {
        OAuth.getAccessToken(data)
          .then(function (data) {
            $state.go('tabs.orders');
          }, function (error) {
            $scope.error_login = 'Username or password is invalid.'
          });
      };
    }
  ])

  .controller('LogoutCtrl', [
    '$scope', '$state', 'logoutService',
    function ($scope, $state, logoutService) {
      $scope.logout = function () {
        logoutService.logout();
        $state.go('login');
      }
    }
  ])

  .controller('RefreshTokenCtrl', [
    '$rootScope', '$state', '$scope', '$timeout', 'OAuth', 'authService', 'logoutService',
    function ($rootScope, $state, $scope, $timeout, OAuth, authService, logoutService) {
      function destroyModal() {
        if ($rootScope.modal) {
          $rootScope.modal.hide();
          $rootScope.modal = false;
        }
      }

      $scope.$on('event:auth-loginConfirmed', function () {
        destroyModal();
      });

      $scope.$on('event:auth-loginCancelled', function () {
        destroyModal();
        logoutService.logout();
        $rootScope.error_login = 'Your session has expired, please log in again!';
      });

      $rootScope.$on('$stateChangeStart',
        function (event, toState, toParams, fromState, fromParams) {
          if ($rootScope.modal) {
            authService.loginCancelled();
            event.preventDefault();
            $state.go('login');
          }
        });

      OAuth.getRefreshToken().then(function () {
        $timeout(function () {
          authService.loginConfirmed();
        }, 10000);
      }, function () {
        authService.loginCancelled();
        $state.go('login');
      });
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

      $scope.show = function (order) {
        $state.go('tabs.order-show', {id: order.id});
      };

      $scope.doRefresh = function () {
        $scope.getOrders();
        $scope.$broadcast('scroll.refreshComplete')
      };

      $scope.getOrders();
    }
  ])

  .controller('OrderShowCtrl', [
    '$scope', '$http', '$state', '$stateParams',
    function ($scope, $http, $state, $stateParams) {
      $http.get('http://localhost:8888/orders/' + $stateParams.id)
        .then(function (data) {
          $scope.order = data.data;
        });

      $scope.back = function () {
        $state.go('tabs.orders');
      };
    }
  ])

  .controller('OrderNewCtrl', [
    '$scope', '$http', '$state', '$stateParams',
    function ($scope, $http, $state, $stateParams) {
      $scope.clients = [];
      $scope.ptypes = [];
      $scope.products = [];
      $scope.statusList = [
        {id: 0, name: 'Pending'},
        {id: 1, name: 'Processing'},
        {id: 2, name: 'Delivered'}
      ];

      $scope.resetOrder = function () {
        $scope.order = {
          client_id: '',
          ptype_id: '',
          status: '',
          total: 0,
          items: []
        }
      };

      $scope.getClients = function () {
        $http.get('http://localhost:8888/clients').then(function (data) {
          $scope.clients = data.data._embedded.clients;
        });
      };

      $scope.getPtypes = function () {
        $http.get('http://localhost:8888/ptypes').then(function (data) {
          $scope.ptypes = data.data._embedded.ptypes;
        });
      };

      $scope.getProducts = function () {
        $http.get('http://localhost:8888/products').then(function (data) {
          $scope.products = data.data._embedded.products;
        });
      };

      $scope.setPrice = function (index) {
        var product_id = $scope.order.items[index].product_id;
        for (var i in $scope.products) {
          if ($scope.products.hasOwnProperty(i) && $scope.products[i].id == product_id) {
            $scope.order.items[index].quantity = 1;
            $scope.order.items[index].price = $scope.products[i].price;
            break;
          }
        }
        $scope.calculateTotalRow(index);
      };

      $scope.addItem = function () {
        $scope.order.items.push({
          product_id: '', quantity: '', price: 0, total: 0
        });
      };

      $scope.calculateTotalRow = function (index) {
        $scope.order.items[index].total = $scope.order.items[index].quantity * $scope.order.items[index].price;
        $scope.calculateTotal();
      };

      $scope.calculateTotal = function () {
        $scope.order.total = 0;
        for (var i in $scope.order.items) {
          if ($scope.order.items.hasOwnProperty(i)) {
            $scope.order.total += $scope.order.items[i].total;
          }
        }
      };

      $scope.save = function () {
        $http.post('http://localhost:8888/orders', $scope.order)
          .then(function (data) {
            $scope.resetOrder();
            $state.go('tabs.orders');
          });
      };

      $scope.resetOrder();
      $scope.getClients();
      $scope.getPtypes();
      $scope.getProducts();
    }
  ])
;
