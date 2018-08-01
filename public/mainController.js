var app = angular.module("myApp", ['ngRoute']); 

// app.config(function($routeProvider) {
//     $routeProvider
//     .when("/home", {
//         templateUrl : "index.html"
//     })
//     .when("/singlePost", {
//         templateUrl : "views/singlePost.html",
//         controller: "mainController"
//     });
// });

app.controller('mainController', function($scope, $http) {
   
     $http.get("http://slimblog.maharshivishwakarma.me/api/posts")
    .then(function(response) {
        $scope.posts = response.data;
      //  console.log(response);
        // var data = response.data;
        // console.log(data);
    });
    
    $scope.submit = function(){
        console.log($scope.blog);
    
    var url = 'http://slimblog.maharshivishwakarma.me/api/posts/add?title='+$scope.blog.title+'&category_ID='+$scope.blog.catID+'&body='+$scope.blog.body;
    console.log(url);
    $http.post(url, function(response){
        console.log(response);
        console.log("data inserted");
    });
    }
      $scope.getSinglePost = function(id){
        console.log(id);
        $http.get("http://slimblog.maharshivishwakarma.me/api/posts/"+id)
    .then(function(response) {
        $scope.posts = response.data;
       
    });
    };
});