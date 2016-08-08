// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'starter.controllers', 'angular-oauth2'])

  .run(function ($ionicPlatform, $rootScope, OAuth, $state) {
    $ionicPlatform.ready(function () {
      if (window.cordova && window.cordova.plugins.Keyboard) {
        // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
        // for form inputs)
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

        // Don't remove this line unless you know what you are doing. It stops the viewport
        // from snapping when text inputs are focused. Ionic handles this internally for
        // a much nicer keyboard experience.
        cordova.plugins.Keyboard.disableScroll(true);
      }
      if (window.StatusBar) {
        StatusBar.styleDefault();
      }
    });

    $rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
      if (toState.name != 'login') {
        if (!OAuth.isAuthenticated()) {
          event.preventDefault();
          $state.go('login');
        }
      }
    });
  })

  .config(function ($stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider) {

    OAuthProvider.configure({
      baseUrl: 'http://localhost:8888',
      clientId: 'testclient',
      clientSecret: 'testpass',
      grantPath: '/oauth',
      revokePath: '/oauth'
    });

    OAuthTokenProvider.configure({
      name: 'token',
      options: {
        secure: false
      }
    });

    $stateProvider
      .state('login', {
        cache: false,
        url: '/login',
        templateUrl: 'templates/login.html',
        controller: 'LoginCtrl'
      })
      .state('tabs', {
        url: '/t',
        abstract: true,
        templateUrl: 'templates/tabs.html'
      })
      .state('tabs.logout', {
        url: '/logout',
        views: {
          'logout-tab': {
            templateUrl: 'templates/logout.html',
            controller: 'LogoutCtrl'
          }
        }
      })
      .state('tabs.orders', {
        cache: false,
        url: '/orders',
        views: {
          'orders-tab': {
            templateUrl: 'templates/orders.html',
            controller: 'OrdersCtrl'
          }
        }
      })
      .state('tabs.orders-create', {
        url: '/orders/create',
        views: {
          'orders-create-tab': {
            templateUrl: 'templates/orders_create.html',
            controller: 'OrderNewCtrl'
          }
        }
      })
      .state('tabs.order-show', {
        url: '/order/show/:id',
        views: {
          'orders-tab': {
            templateUrl: 'templates/order_show.html',
            controller: 'OrderShowCtrl'
          }
        }
      })
    ;

    $urlRouterProvider.otherwise('/login');
  })
;
