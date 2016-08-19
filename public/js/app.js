var app = angular.module('yunzhiclub', ['ionic']);

app.constant('$ionicLoadingConfig', {
    template: 'Default Loading ......'
});

app.controller('MyCtrl' , function($scope, $ionicModal){
    $ionicModal.fromTemplateUrl('my-modal.html',{
        scope: $scope,
        animation: 'slide-in-up'
    }).then(function(modal){
        $scope.modal = modal;
    });

    $scope.openModal = function(){
        $scope.modal.show();
    };

    $scope.closeModal = function(){
        $scope.modal.hide();
    };
});
app.controller('HideShowController' , function($scope){
    $scope.menuState = false;
    $scope.name = { text: '编辑',color:'positive' };

    $scope.toggleMenu = function(){
      $scope.menuState = !$scope.menuState;
      $scope.name = {text:'删除',color:'assertive',col:'col-90'};
    };
    
});