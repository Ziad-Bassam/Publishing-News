<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Services\PostService;

use function PHPUnit\Framework\isNull;

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }



    public function index()
    {

        // 1- create database
        // 2- create table (id , title (varchar) , description (text) , created_at , updated_at)

        // Query = selcte * from posts

        // collection object
        $postsFromeDB = $this->postService->getAllPosts();
        return view('posts.index', ['posts' => $postsFromeDB]);
    }





    public function show($postId)
    {

        // Query = selcte * from posts where id = $post_id
        // We Have 3 ways to do this Query

        // first way
        // $SinglePostFromDB = post::findorfail($postId);

        // Second way

        //$SinglePostFromDB = post::where('id' , $postId)->first(); //==single result


        //third way

        // $SinglePostFromDB = post::where('id' , $postId)->get(); // == collection object


        // post::where('title', 'php')->frist(); //select * from posts where title = php limit 1
        // post::where('title', 'php')->get(); //select * from posts where title = php





        // to solve write id not exist there is two way



        // first way

        // if (is_null($SinglePostFromDB)) {
        //     return to_route('posts.index');
        // }


        //Second way // when do query do this

        // $SinglePostFromDB = post::findorfail($postId);



        $SinglePostFromDB = $this->postService->getPostById($postId);


        return view('posts.show', ['post' => $SinglePostFromDB]);
    }




    public function create()
    {

        // select * from Users
        $users = $this->postService->getAllUsers();


        return view('posts.create', ['users' => $users]);
    }




    public function store(PostRequest $request)
    {

        // code validation

        // 1- get the user data
        //$data = $_POST;  this isn't framework way
        // 1-
        $data = $request->validated();

        $this->postService->createPost($data); // insert into posts (title,description)
        //there second way to insert data in database (search)
        // 3- redirection to posts.index
        return to_route('posts.index');
    }




    public function edit($postId)
    {
        $users = $this->postService->getAllUsers();
        $SinglePostFromDB = $this->postService->getPostById($postId);
        return View('posts.edit', ['users' => $users, 'post' => $SinglePostFromDB]);
    }






    public function update(PostRequest $request , $postId)
    {
        $data = $request->validated();

        $this->postService->updatePost($postId, $data);

        return to_route('posts.show', parameters: $postId);
    }


    public function destroy($postId)
    {

        //1- delete the post in database
        $this->postService->deletePost($postId);

        //2- redirection to posts.index
        return to_route('posts.index');
    }
}
