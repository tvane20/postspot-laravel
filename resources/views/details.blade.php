@extends('layouts.layout')

@section('content')
        
        <h1>Post </h1>

        <div>
                <h3>Titre</h3>
                <p>{{$post->title}}</p>

                <h3>Contenu</h3>
                <p>{{$post->content}}</p>
                <span>crée le: {{$post->created_at}}</span>
                <a href="{{route('post.edit', ['post' =>$post])}}">editer</a>
                <div>
                        <form method="POST" action="{{route('post.destroy', ['post' =>$post])}}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="delete" />
                        </form>
                </div>
        </div>
        
   
@endsection