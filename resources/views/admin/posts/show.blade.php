@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Post: {{$post->title}}</h1>

        @if ($post->category)
            <h3>Categoria: {{$post->category->name}}</h3>
        @endif

        <div class="show-tags">

            @if ($post->tags)

            <span>Tags: </span>
            @forelse ($post->tags as $tag)
            {{ $tag->name }}
            @empty
            <p>-</p>
            @endforelse

            @endif

        </div>

        <div class="show-post">
            <span>Descrizione Post: </span>{{$post->description}}
        </div>

        <div>
            <a class="btn btn-primary" href="{{route('admin.posts.index')}}">Torna all'elenco</a>
        </div>

    </div>

@endsection
