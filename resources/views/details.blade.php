@extends('layouts.layout')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-8">Détails du Post</h1> <!-- Titre centré en gris -->

        <div class="bg-white shadow-md rounded-lg mx-auto w-full max-w-lg p-6"> <!-- Carte centrée et format ajusté -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Catégorie</h3> <!-- Titre en gris -->
                <p class="mt-1 text-gray-600">
                    @if($post->category)
                        <strong>{{ $post->category->name }}</strong>
                    @else
                        <em>Aucune catégorie assignée.</em>
                    @endif
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-xl font-bold text-gray-900">{{ $post->title }}</h5> <!-- Titre du post -->
                <p class="mt-3 text-gray-600">{{ $post->content }}</p> <!-- Contenu du post -->
            </div>

            <p>Créé par : {{ $post->user->name }}</p>
            <p class="text-sm text-gray-500 mt-6">Créé le : {{ $post->created_at->format('d/m/Y à H:i') }}</p> <!-- Date de création -->

            @if(Auth::check()) <!-- Vérifie si l'utilisateur est connecté -->
                <p class="text-sm text-gray-500 mt-4">Statut : <strong>{{ $post->status }}</strong></p> <!-- Affiche le statut -->
            @endif

            <div class="flex justify-center mt-8 space-x-4"> <!-- Centrer les boutons -->
                @if(auth()->check() && $post->status !='publié' && (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Auteur')))

                <a href="{{ route('post.edit', ['post' => $post]) }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow hover:bg-blue-600 transition ease-in-out duration-150">Éditer</a> <!-- Bouton d'édition -->
                <form method="POST" action="{{ route('post.destroy', ['post' => $post]) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="px-4 py-2 bg-white border border-red-500 text-red-500 font-semibold rounded-md shadow hover:bg-red-50 transition ease-in-out duration-150">Supprimer</button> <!-- Bouton de suppression -->
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
