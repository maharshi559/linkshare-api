var app = angular.module("myApp", ['ngRoute']); 

app.controller('singlePost', function($scope, $http) {

      $scope.getSinglePost = function(id){
        console.log(id);
        $http.get("http://slimblog.maharshivishwakarma.me/api/posts/"+id)
    .then(function(response) {
        $scope.posts = response.data;
       
    });
    };
});