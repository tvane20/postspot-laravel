@extends('layouts.layout')

@section('content')
        
        <h1>Editer un post</h1>

         <!-- Formulaire d'edition' de post -->
         <form action="{{route('post.update', ['post' => $post])}}" method="POST">
            @csrf  <!-- Protection CSRF -->
            @method('put')
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="brouillon" >Brouillon</option>
                    <option value="publié" >Publié</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">modifier</button>
        </form>
        
   
@endsection