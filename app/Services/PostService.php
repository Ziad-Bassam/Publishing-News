<?php
namespace App\Services;

use App\Models\Post;
use App\Models\User;

class PostService
{

    public function getAllPosts()
    {
        // Logic to retrieve all posts
        return Post::all();
    }


    public function getPostById($postId)
    {
        // Logic to retrieve a single post by ID
        return Post::findOrFail($postId);
    }

    public function getAllUsers()
    {
        return User::all();
    }



    public function createPost(array $data)
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->user_id = $data['post_creator'];
        $post->save();
        return $post;
    }

    public function updatePost($postId, array $data)
    {
        $post = Post::findOrFail($postId);

        $post->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);

        return $post;
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
    }
}
