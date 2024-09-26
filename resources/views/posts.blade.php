@extends('layouts.layout')

@section('content')
        
        <h1>Voir les Posts</h1>

        <div>
                <a href="{{route('post.create')}}">Créer un post</a>
        </div>
        <div>
                @if (session()->has('success'))
                <div>
                        {{session('success')}}
                </div>
                        
                @endif
        </div>
        <div>
                @foreach ($posts as $post )
                <h3>Titre</h3>
                <p>{{$post->title}}</p>

                <h3>Contenu</h3>
                <p>{{$post->content}}</p>
                <span>crée le: {{$post->created_at}}</span>
                <a href="{{ route('post.show', ['id' => $post->id]) }}">Voir les détails</a>
                        <a href="{{route('post.edit', ['post' =>$post])}}">editer</a>
                        <div>
                                <form method="POST" action="{{route('post.destroy', ['post' =>$post])}}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="delete" />
                                </form>
                        </div>
                        
                @endforeach
        </div>
   
@endsection