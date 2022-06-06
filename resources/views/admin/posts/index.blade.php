@extends('layouts.dashboard')

@section('content')
<div class="row justify-content-between">
    <div class="col-auto">
        <h1>Tutti i posts</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Crea nuovo post</a>
    </div>
</div>
<table class="table border-top border-bottom">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titolo</th>
            <th>Slug</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('admin.posts.show', $post->id) }}">Dettaglio</a>
                    <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
                    <form class="d-inline-block" action="{{route('admin.posts.destroy' ,  $post->id)}}" method="POST">
                        @csrf
                            @method('DELETE')

                            <button class="btn btn-danger" onclick="return confirm('Sicuro di eliminare il Post?');">
                                Cancella il post
                            </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
