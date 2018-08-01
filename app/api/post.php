<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;
// get all posts
$app->get('/api/posts', getPosts);

// get single post
$app->get('/api/posts/{id}', getPostWithID);

// Add posts
$app->post('/api/posts/add',postPosts);

// Update
$app->put('/api/posts/update/{id}', putPosts );


$app->delete('/api/posts/delete/{id}',deletePosts);


function getPosts(Request $request, Response $response){
	//echo 'POSTS';

	$sql = "SELECT * FROM posts";

	try{
		
		// get db object
		$db =  new db();
		//connect
		$db = $db->connect();
		
		$stm = $db->query($sql);
		$posts = $stm->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		
		  echo json_encode($posts);

	}
	catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}}';
	}

};

function getPostWithID(Request $request, Response $response){
	//echo 'POSTS';
	$id = $request->getAttribute('id');
	$sql = "SELECT * FROM posts WHERE ID = $id";
	//echo $id;
	try{
		
		// get db object
		$db =  new db();
		//connect
		$db = $db->connect();
		
		$stm = $db->query($sql);
		$posts = $stm->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		  echo json_encode($posts);
	}
	catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}}';
	}

};

function postPosts(Request $request, Response $response){
	//echo 'POSTS';
	$title = $request->getParam('title');
	$category_ID = $request->getParam('category_ID');
	$body = $request->getParam('body');


	$sql = "INSERT INTO posts(title,category_ID,body) VALUES (:title,:category_ID,:body)";

	try{
		
		
		$db =  new db();
		
		$db = $db->connect();
		
		$stm = $db->prepare($sql);

		$stm->bindParam(':title',$title);
		$stm->bindParam(':category_ID',$category_ID);
		$stm->bindParam(':body',$body);
		
		$stm->execute();

		  echo '{"notice": {"text":"Post Added"}}';
	}
	catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}}';
	}
};

function putPosts(Request $request, Response $response){
	//echo 'POSTS';

	$id = $request->getAttribute('id');

	$title = $request->getParam('title');
	$category_ID = $request->getParam('category_ID');
	$body = $request->getParam('body');


	$sql = "UPDATE posts SET title = :title,category_ID = :category_ID,body = :body WHERE ID= $id";

	try{
		
		$db =  new db();
		
		$db = $db->connect();
		
		$stm = $db->prepare($sql);

		$stm->bindParam(':title',$title);
		$stm->bindParam(':category_ID',$category_ID);
		$stm->bindParam(':body',$body);
		
		$stm->execute();

		  echo '{"notice": {"text":"Post '.$id.' Updated with "}}';
	}
	catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}}';
	}
};

function deletePosts(Request $request, Response $response){
	//echo 'POSTS';

	$id = $request->getAttribute('id');

	// $title = $request->getParam('title');
	// $category_ID = $request->getParam('category_ID');
	// $body = $request->getParam('body');


	$sql = "DELETE from posts WHERE ID= $id";

	try{
		
		$db =  new db();
		
		$db = $db->connect();
		
		$stm = $db->prepare($sql);

		// $stm->bindParam(':title',$title);
		// $stm->bindParam(':category_ID',$category_ID);
		// $stm->bindParam(':body',$body);
		
		$stm->execute();

		  echo '{"notice": {"text":"Post '.$id.' Deleted "}}';
	}
	catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}}';
	}

}