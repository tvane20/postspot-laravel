@extends('layouts.layout')

@section('content')
    <div class="container mx-auto text-center my-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Bienvenue sur Mon Blog</h1>
        <p class="text-gray-600 mb-6">Découvrez nos derniers articles et partagez vos pensées avec nous.</p>

        <div class="flex justify-center mb-4">
            <img src="https://via.placeholder.com/300" alt="Image de bienvenue" class="rounded-lg shadow-md">
        </div>

        <a href="{{ route('post.index') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Voir les Posts</a>

        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800">Pourquoi nous choisir ?</h2>
            <ul class="list-disc list-inside text-left mt-2 text-gray-600">
                <li>Articles variés sur différents sujets.</li>
                <li>Communauté active et engagée.</li>
                <li>Possibilité de partager vos propres écrits.</li>
            </ul>
        </div>

        <footer class="mt-8 text-gray-500">
            <p>© {{ date('Y') }} Mon Blog. Tous droits réservés.</p>
        </footer>
    </div>
@endsection
