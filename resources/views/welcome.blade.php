@extends('layouts.layout')

@section('content')
    <div class="container mx-auto text-center my-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Bienvenue sur Mon Blog</h1>
        <p class="text-gray-600 mb-6">Découvrez nos derniers articles et partagez vos pensées avec nous.</p>

        <div class="flex justify-center mb-4">
            <img src="https://f.hellowork.com/blogdumoderateur/2013/04/images-libres.jpg" alt="Image de bienvenue" class="rounded-lg shadow-md">
        </div>

        @if (Auth::check())
            <a href="{{ route('post.index') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Voir les Posts</a>
        @else
            <p class="text-red-600 mt-4">Veuillez vous <a href="{{ route('login') }}" class="text-blue-600 underline">connecter</a> ou vous <a href="{{ route('register') }}" class="text-blue-600 underline">inscrire</a> pour voir les posts.</p>
        @endif

        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pourquoi nous choisir ?</h2>
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <ul class="list-disc list-inside text-left mt-2 text-gray-600">
                    <li class="mb-2 flex items-start">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 00-1 1v7H2a1 1 0 000 2h7v7a1 1 0 002 0v-7h7a1 1 0 000-2h-7V3a1 1 0 00-1-1z" />
                        </svg>
                        Articles variés sur différents sujets.
                    </li>
                    <li class="mb-2 flex items-start">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 00-1 1v7H2a1 1 0 000 2h7v7a1 1 0 002 0v-7h7a1 1 0 000-2h-7V3a1 1 0 00-1-1z" />
                        </svg>
                        Communauté active et engagée.
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 00-1 1v7H2a1 1 0 000 2h7v7a1 1 0 002 0v-7h7a1 1 0 000-2h-7V3a1 1 0 00-1-1z" />
                        </svg>
                        Possibilité de partager vos propres écrits.
                    </li>
                </ul>
            </div>
        </div>
        

        <footer class="mt-8 text-gray-500">
            <p>© {{ date('Y') }} Mon Blog. Tous droits réservés.</p>
        </footer>
    </div>
@endsection
