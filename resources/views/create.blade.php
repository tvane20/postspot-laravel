@extends('layouts.layout')

@section('content')
        
        <h1>Créer un nouveau post</h1>

         <!-- Formulaire de création de post -->
         <form action="{{route('post.store')}}" method="POST">
            @csrf  <!-- Protection CSRF -->
            @method('post')
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="brouillon" >Brouillon</option>
                    <option value="publié" >Publié</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
        
   
@endsection