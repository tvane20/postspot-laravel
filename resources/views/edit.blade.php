@extends('layouts.layout')

@section('content')
    <div class="container my-4">
        <h1 class="text-secondary mb-4 text-center" style="font-size: 2rem;">Éditer un Post</h1>

        <form action="{{ route('post.update', ['post' => $post]) }}" method="POST" class="bg-white border border-gray-200 rounded-lg p-6 shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" id="title" name="title" value="{{ $post->title }}" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Contenu</label>
                <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
            </div>

            <div class="mb-4">
                <input type="hidden" name="status" value="brouillon">
            </div>
            
            @if(auth()->user()->hasRole('Admin'))
    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" id="status" name="status" required>
            <option value="brouillon" {{ $post->status == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
            <option value="publié" {{ $post->status == 'publié' ? 'selected' : '' }}>Publié</option>
        </select>
    </div>
@endif


            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" id="category_id" name="category_id" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</button>
        </form>
    </div>
@endsection
