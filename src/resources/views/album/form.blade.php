@extends('layout')
 
@section('content')
 
    <h1>{{ $title }}</h1>
 
    @if ($errors->any())
        <div class="alert alert-danger">Please correct the mistakes!</div>
    @endif
    

    <form method="post" action="{{ $album->exists ? '/albums/patch/' . $album->id : '/albums/put' }}">
        @csrf
 
        <div class="mb-3">
            <label for="album-title" class="form-label">Album title</label>
 
            <input 
                type="text" 
                class="form-control @error('title') is-invalid @enderror" 
                id="album-title" 
                name="title"
                value="{{ old('title', $album->title) }}"
            >
 
            @error('title')
                <p class="invalid-feedback">{{ $errors->first('title') }}</p>
            @enderror
 
        </div>

        <div class="mb-3">
            <label for="album-year" class="form-label">Year</label>
 
            <input 
                type="number" 
                class="form-control @error('year') is-invalid @enderror" 
                id="album-title" 
                name="year"
                value="{{ old('year', $album->year) }}"
            >
 
            @error('year')
                <p class="invalid-feedback">{{ $errors->first('year') }}</p>
            @enderror
 
        </div>
 
        <button type="submit" class="btn btn-primary">{{ $album->exists ? "Edit" : "Add" }}</button>
 
    </form>
 
@endsection