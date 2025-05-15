@extends('layout')
 
@section('content')
 
<h1>{{ $title }}</h1>
 
@if ($errors->any())
    <div class="alert alert-danger">Please fill the form correctly</div>
@endif
 
<form
    method="post"
    action="{{ $song->exists ? '/songs/patch/' . $song->id : '/songs/put' }}"
    enctype="multipart/form-data"
>
    @csrf
 
    <div class="mb-3">
        <label for="song-name" class="form-label">Name</label>
 
        <input
            type="text"
            id="song-name"
            name="name"
            value="{{ old('name', $song->name) }}"
            class="form-control @error('name') is-invalid @enderror"
        >
 
        @error('name')
            <p class="invalid-feedback">{{ $errors->first('name') }}</p>
        @enderror
    </div>
 
    <div class="mb-3">
        <label for="song-artist" class="form-label">Artist</label>
 
        <select
            id="song-artist"
            name="artist_id"
            class="form-select @error('artist_id') is-invalid @enderror"
        >
            <option value="">Choose artist!</option>
                @foreach($artists as $artist)
                    <option
                        value="{{ $artist->id }}"
                        @if ($artist->id == old('artist_id', $song->artist->id ?? false)) selected @endif
                    >{{ $artist->name }}</option>
                @endforeach
        </select>
 
        @error('artist_id')
            <p class="invalid-feedback">{{ $errors->first('artist_id') }}</p>
        @enderror
    </div>
 
    <div class="mb-3">
        <label for="song-album" class="form-label">Album</label>
 
        <select
            id="song-album"
            name="album_id"
            class="form-select @error('album_id') is-invalid @enderror"
        >
            <option value="">Choose album!</option>
                @foreach($albums as $album)
                    <option
                        value="{{ $album->id }}"
                        @if ($album->id == old('album_id', $song->album->id ?? false)) selected @endif
                    >{{ $album->title }}</option>
                @endforeach
        </select>
 
        @error('artist_id')
            <p class="invalid-feedback">{{ $errors->first('artist_id') }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="song-description" class="form-label">Description</label>
 
        <textarea
            id="song-description"
            name="description"
            class="form-control @error('description') is-invalid @enderror"
        >{{ old('description', $song->description) }}</textarea>
 
        @error('description')
            <p class="invalid-feedback">{{ $errors->first('description') }}</p>
        @enderror
    </div>
 
    <div class="mb-3">
        <label for="song-year" class="form-label">Year</label>
 
        <input
            type="number" max="{{ date('Y') + 1 }}" step="1"
            id="song-year"
            name="year"
            value="{{ old('year', $song->year) }}"
            class="form-control @error('year') is-invalid @enderror"
        >
 
        @error('year')
            <p class="invalid-feedback">{{ $errors->first('year') }}</p>
        @enderror
    </div>
 
    <div class="mb-3">
        <label for="song-image" class="form-label">Image</label>
    
        @if ($song->image)
            <img
                src="{{ asset('images/' . $song->image) }}"
                class="img-fluid img-thumbnail d-block mb-2"
                alt="{{ $song->name }}"
            >
        @endif
    
        <input
            type="file" accept="image/png, image/jpeg, image/webp"
            id="song-image"
            name="image"
            class="form-control @error('image') is-invalid @enderror"
        >
    
        @error('image')
            <p class="invalid-feedback">{{ $errors->first('image') }}</p>
        @enderror
    </div>

 
    <div class="mb-3">
        <div class="form-check">
            <input
                type="checkbox"
                id="song-display"
                name="display"
                value="1"
                class="form-check-input @error('display') is-invalid @enderror"
                @if (old('display', $song->display)) checked @endif
            >
            <label class="form-check-label" for="band-display">
                Publish
            </label>
 
            @error('display')
                <p class="invalid-feedback">{{ $errors->first('display') }}</p>
            @enderror
        </div>
    </div>
 
    <button type="submit" class="btn btn-primary">
        {{ $song->exists ? 'Edit' : 'Add' }}
    </button>
</form>
 
@endsection

