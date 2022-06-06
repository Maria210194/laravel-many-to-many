@extends('layouts.dashboard')

@section('content')
<div class="row justify-content-between">
    <div class="col-auto">
        <h1>Visualizzazione post {{$post->id}}</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Tutti i post</a>
    </div>
</div>

<dl>
    <dt>Titolo</dt>
    <dd>{{$post->title}}</dd>
    <dt>Slug</dt>
    <dd>{{$post->slug}}</dd>
    <dt>Categoria</dt>
    <dd>{{$category->name}}</dd>
    <dt>Contenuto</dt>
    <dd>{{$post->content}}</dd>
</dl>
    <a class="btn btn-warning" href="{{ route("admin.posts.edit", $post->id) }}">Modifica</a>
    <form class="d-inline-block" action="{{route('admin.posts.destroy' ,  $post->id)}}" method="POST">
        @csrf
            @method('DELETE')

            <button class="btn btn-danger" onclick="return confirm('Are you sure you wanna delete the Post?');">
                Delete
            </button>
    </form>

@endsection
