angular.module('starter.services', [])

  .service('oauthFixInterceptor', [
    '$q', '$rootScope', 'OAuthToken',
    function ($q, $rootScope, OAuthToken) {
      return {
        request: function (config) {
          if (OAuthToken.getAuthorizationHeader()) {
            config.headers = config.headers || {};
            config.headers.Authorization = OAuthToken.getAuthorizationHeader();
          }

          return config;
        },
        responseError: function (rejection) {
          if (rejection.status == 400 && rejection.data &&
            (rejection.statusText == 'invalid_request' || rejection.statusText == 'invalid_grant')) {
            OAuthToken.removeToken();
            $rootScope.$emit('oauth:error', {rejection: rejection});
          }

          if (rejection.status == 401) {
            var deffered = $q.defer();
            $rootScope.$emit('oauth:error', {rejection: rejection, deffered: deffered});
            return deffered.promise;
          }

          return $q.reject(rejection);
        }
      };
    }])

  .service('logoutService', [
    'OAuthToken', '$ionicHistory',
    function (OAuthToken, $ionicHistory) {
      return {
        logout: function () {
          OAuthToken.removeToken();
          $ionicHistory.clearCache();
          $ionicHistory.clearHistory();
          $ionicHistory.nextViewOptions({
            disabledBack: true,
            historyRoot: true
          });
        }
      };
    }])
;
