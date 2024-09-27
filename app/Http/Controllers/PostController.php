<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Initialiser la requête
        $query = Post::with('category');

        // Vérifiez si l'utilisateur est connecté
        if (!auth()->check() || auth()->user()->hasRole('Visiteur')) {
            $query->where('status', 'publié');
            $posts = $query->get();
        } else {
            $posts = $query->get();
            
        }

        // Appliquer le filtre par catégorie si une catégorie est sélectionnée
        if ($request->filled('category_id')) {
            $posts = $posts->where('category_id', $request->category_id);
        }

        $categories = Category::all(); // Récupération de toutes les catégories
        
        // Passer les deux variables à la vue
        return view('posts', compact('posts', 'categories'));
    }


    public function show ($id) {
        $post = Post::find($id);

        if (!$post) {
            return redirect('/posts')->with('error', 'Post introuvable.');
        }
        
        return view('details', ['post' => $post]);
    }

    public function create()
{
    $post = new Post();
    $categories = Category::all(); // Récupération de toutes les catégories
    return view('create', compact('categories')); // Passage de la variable à la vue
}

public function store(Request $request) {
    $data = $request->validate([
        'title' => 'required',
        'content' => 'required',
        'category_id' => 'nullable|exists:categories,id',
        'new_category' => 'nullable|string|max:255',
        'status' => 'required|in:brouillon', // Seulement les brouillons peuvent être créés par tous
    ]);

    // Si une nouvelle catégorie est fournie, la créer
    if ($request->filled('new_category')) {
        $category = new Category();
        $category->name = $request->new_category;
        $category->save();
        $data['category_id'] = $category->id; // Assigner l'ID de la nouvelle catégorie
    }

    if (Auth::check()) {
        $data['user_id'] = Auth::id();
        Post::create($data);
    } else {
        return redirect()->back()->withErrors(['message' => 'Vous devez être connecté pour créer un post.']);
    }

    return redirect(route('post.index'))->with('success', 'Post créé avec succès.');
}

public function edit(Post $post) {
    // Vérifie si l'utilisateur est soit l'auteur soit Admin
    if (auth()->user()->id !== $post->user_id && !auth()->user()->hasRole('Admin')) {
        return redirect('post.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce post.');
    }

    // Si l'utilisateur est un Auteur, il ne peut pas modifier un post publié
    if (auth()->user()->hasRole('Auteur') && $post->status === 'publié') {
        return redirect()->back()->with('error', 'Vous ne pouvez pas modifier un post publié.');
    }

    $categories = Category::all();
    return view('edit', compact('post', 'categories'));
}


public function update(Post $post, Request $request) {
    // Valide les données du formulaire
    $data = $request->validate([
        'title' => 'required',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
        'status' => 'required|in:brouillon,publié',
    ]);

    // Si l'utilisateur est un Auteur, il ne peut pas modifier un post publié
    if (auth()->user()->hasRole('Auteur') && $post->status === 'publié') {
        return redirect()->back()->with('error', 'Vous ne pouvez pas modifier un post publié.');
    }

    // Si l'utilisateur n'est pas Admin, le statut doit rester 'brouillon'
    if (!auth()->user()->hasRole('Admin')) {
        $data['status'] = 'brouillon';
    }

    $post->update($data);

    return redirect(route('post.index'))->with('success', 'Post modifié avec succès.');
}


    public function destroy(Post $post){
        $post->delete();

        return redirect(route('post.index'))->with('success', 'Post supprimé avec succes');

    }

    public function publish(Post $post)
{
    // Vérifie si l'utilisateur a le rôle Admin
    if (!auth()->user()->hasRole('Admin')) {
        abort(403, 'Action non autorisée.');
    }

    // Publie le post
    $post->publish();

    return redirect(route('post.index'))->with('success', 'Post publié avec succès.');
}


    public function filterByCategory($categoryId){
        $posts = Post::where('category_id', $categoryId)->where('status', 'published')->get();
            return view('posts', compact('posts'));
        }
}
