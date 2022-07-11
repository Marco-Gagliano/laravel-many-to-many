@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center fw-bold">Pagina Principale</h1>

        @if (session('post_deleted'))
        <div class="alert alert-danger" role="alert">
            {{session('post_deleted')}}
        </div>
        @endif


        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>

            <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category ? $post->category->name : '-'}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.posts.show', $post)}}">MOSTRA</a>
                            <a class="btn btn-warning" href="{{route('admin.posts.edit', $post)}}">MODIFICA</a>
                            <form   class="d-inline"
                                    onsubmit="return confirm ('Sei sicuro di voler eliminare il post {{$post->id}} {{$post->title}} ?')"
                                    action="{{route('admin.posts.destroy', $post)}}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">CANCELLA</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="paginate d-flex justify-content-center">{{$posts->links()}}</div>

        <div class="category-list ">
            <h2 class="mb-5">Elenco lista post per categoria:</h2>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="list col-4">
                        <h4><strong>{{$category->name}}</strong></h4>

                            <ul>

                                @forelse ($category->posts as $post)
                                    <li>
                                        <a href="{{route('admin.posts.show', $post)}}">{{$post->title}}</a>
                                    </li>
                                @empty
                                    <p>Non sono presenti post per questa categoria</p>
                                @endforelse
                            </ul>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
