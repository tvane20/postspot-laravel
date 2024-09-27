@extends('layouts.layout')

@section('content')
    <div class="container my-4">
        <h1 class="text-secondary mb-4 text-center" style="font-size: 2rem;">Créer un Post</h1>

        <form action="{{ route('post.store') }}" method="POST" class="bg-white border border-gray-200 rounded-lg p-6 shadow-md">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" id="title" name="title" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Contenu</label>
                <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select id="category" name="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" >
                    <option value="">Sélectionner une catégorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="button" id="add-category-btn" class="mt-2 text-indigo-600 hover:text-indigo-900">Ajouter une nouvelle catégorie</button>
                <div id="new-category-container" class="hidden mt-2">
                    <input type="text" id="new-category" name="new_category" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Nom de la nouvelle catégorie">
                </div>
            </div>

            <div class="mb-4">
                <input type="hidden" name="status" value="brouillon">
            </div>

            @if(auth()->user()->hasRole('Admin'))
    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" id="status" name="status" required>
            <option value="brouillon" {{ old('status', $post->status ?? 'brouillon') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
            <option value="publié" {{ old('status', $post->status ?? '') == 'publié' ? 'selected' : '' }}>Publié</option>
                    </select>
    </div>
@endif


            <button type="submit" class="text-indigo-600 hover:text-indigo-900 mr-3">Créer</button>
        </form>
    </div>

    <script>
        document.getElementById('add-category-btn').addEventListener('click', function() {
            document.getElementById('new-category-container').classList.toggle('hidden');
        });
    </script>
@endsection
