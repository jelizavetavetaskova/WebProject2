@extends('layout')
 
@section('content')
 
    <h1>{{ $title }}</h1>
 
    @if (count($items) > 0)
 
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <th>ID</td>
                    <th>Title</td>
                    <th>Year</td>
                    <th>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
 
            @foreach($items as $album)
            <tr>
                <td>{{ $album->id }}</td>
                <td>{{ $album->title }}</td>
                <td>{{ $album->year }}</td>
                <td>
                    <a href="/albums/update/{{ $album->id }}" class="btn btn-outline-primary btn-sm">Edit</a> 
                    / 
                    <form action="/albums/delete/{{ $album->id }}" method="post" class="deletion-form d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
 
            </tbody>
        </table>
 
    @else
 
        <p>Not found</p>
 
    @endif

    <a href="/albums/create" class="btn btn-primary">Add new album</a>
 
@endsection