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
      };
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
