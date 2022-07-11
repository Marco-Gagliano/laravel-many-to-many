@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crea un nuovo post</h1>

        {{-- @if ($errors->any())
            <div class="col-6 offeset-3 alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{route('admin.posts.store')}}" method=POST>
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Titolo</label>
                {{-- il name dell'input deve risultare al nome della colonna della tabella di riferimento --}}
                <input  value="{{old("title")}}"
                        type="text"
                        id="title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="Inserisci il titolo del post">
                        @error('title')
                            <p class="text-danger fw-bold"><strong>{{$message}}</strong></p>
                        @enderror
                        <p class="text-danger fw-bold" id=error-title></p>
            </div>

            <div class="mb-3">
                <label  for="description" class="form-label fw-bold">Contenuto del post</label>
                <textarea   value="{{old("description")}}"
                            name="description"
                            id="description"
                            type="text"
                            class="form-control @error('description') is-invalid @enderror"
                            cols="30"   rows="10"
                            placeholder="Inserisci la descrizione del post">{{old("description")}}</textarea>
                @error('description')
                    <p class="text-danger fw-bold"><strong>{{$message}}</strong></p>
                @enderror
                <p class="text-danger fw-bold" id=error-description></p>
            </div>

            <div class="select-category mb-3">
                <label for=""><h6>Categoria: </h6></label>
                <select class="form-select my-3" name="category_id">

                    <option value="">Selezionare Categoria</option>
                    @foreach ($categories as $category)
                        <option @if ($category->id == old('category_id')) selected
                                @endif
                                value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="select-tag mb-3">
                @foreach ($tags as $tag)
                    <input  type="checkbox"
                            value="{{ $tag->id }}"
                            name="tags[]"
                            id="tag{{ $loop->iteration }}"
                            @if(in_array($tag->id, old('tags', []))) checked @endif>

                    <label for="tag{{$loop->iteration}}">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success fw-bold">Invia</button>

        </form>
    </div>
@endsection
