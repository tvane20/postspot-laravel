<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index () {
        $posts = Post::all();
        return view('posts', ['posts' => $posts]);
    }

    public function show ($id) {
        $post = Post::find($id);

        if (!$post) {
            return redirect('/posts')->with('error', 'Post introuvable.');
        }
        
        return view('details', ['post' => $post]);
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request ) {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required', 
        ]);

        $newPost = Post::create($data);

        return redirect(route('post.index'));
    }
    public function edit (Post $post) {
       // dd($post);
       return view('edit', ['post' => $post]);

    }

    public function update(Post $post, Request $request){
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required', 
        ]);

        $post->update($data);

        return redirect(route('post.index'))->with('success', 'Post modifié avec succes');
    }

    public function destroy(Post $post){
        $post->delete();

        return redirect(route('post.index'))->with('success', 'Post supprimé avec succes');

    }
}
