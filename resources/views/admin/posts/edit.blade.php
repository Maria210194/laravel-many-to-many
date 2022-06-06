@extends('layouts.dashboard')

@section('content')
<div class="row justify-content-between">
    <div class="col-auto">
        <h1>Modifica post{{$post->id}}</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Tutti i post</a>
    </div>
</div>
<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<form action="{{ route("admin.posts.update", $post)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Titolo</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Inserisci il titolo" value="{{ old("title", $post->title) }}">
        @error("title")
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="form-group">
        <label>Slug</label>
        <span class="form-group">{{$post->slug}}</span>
    </div>

    <div class="form-group">
        <label>Categoria</label>
        <select name="category_id" class="@error('category_id') is-invalid @enderror">
            <option>Seleziona la categoria</option>
            @foreach ($categories as $category)
                <option value=" {{$category->id}}"
                    {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''}}>
                    {{$category->name}}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="form-group">
        <label for="content">Contenuto</label>

        <textarea name="content" cols="30" rows="10" class="form-control @error('title') is-invalid @enderror" placeholder="Scrivi qui...">{{ old("content", $post->content) }}</textarea>

        @error("content")
            <div class="d-block invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Aggiorna post</button>
    </div>
</form>

@endsection
