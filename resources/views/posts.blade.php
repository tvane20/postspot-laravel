@extends('layouts.layout')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="mb-4 flex justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Posts</h2>

            @if(auth()->check() && (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Auteur')))
    <a href="{{ route('post.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Créer un Post
    </a>
@endif

        
            
        </div>

        @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

        <!-- Message de succès -->
        @if (session()->has('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Formulaire de filtre par catégorie -->
        <form action="{{ route('post.index') }}" method="GET" class="mb-6">
            <div class="flex space-x-4">
                <div class="flex-1">
                    <select name="category_id" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="this.form.submit()">
                        <option value="">Tous les Posts</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-shrink-0">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Filtrer</button>
                </div>
            </div>
        </form>

        <!-- Affichage du message si aucun post n'est présent -->
        @if($posts->isEmpty())
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <p class="text-gray-600">Pas de posts pour le moment, ajoutez-en un en cliquant <a href="{{ route('post.create') }}" class="text-blue-500 hover:underline">ICI</a>.</p>
            </div>
        @else
            <!-- Tableau des Posts dans une carte pleine largeur -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="w-full overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('post.show', $post->id) }}" class="text-sm font-medium text-gray-900 hover:underline">{{ $post->title }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($post->category)
                                            <span class="text-sm font-semibold text-gray-700">{{ $post->category->name }}</span>
                                        @else
                                            <span class="text-sm italic text-gray-500">Aucune catégorie assignée</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        
                                            <span class="text-sm font-semibold text-gray-700">{{ $post->status }}</span>
                                       
                                            
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if(auth()->check() && (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Auteur')))

                                        <a href="{{ route('post.edit', $post->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</a>
                                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
