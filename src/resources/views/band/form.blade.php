
@extends('layout')
 
@section('content')
 
<h1>{{ $title }}</h1>
 
@if ($errors->any())
    <div class="alert alert-danger">Please fill the form correctly</div>
@endif
 
<form
    method="post"
    action="{{ $band->exists ? '/bands/patch/' . $band->id : '/bands/put' }}"
    enctype="multipart/form-data"
>
    @csrf
 
    <div class="mb-3">
        <label for="band-name" class="form-label">Name</label>
 
        <input
            type="text"
            id="band-name"
            name="name"
            value="{{ old('name', $band->name) }}"
            class="form-control @error('name') is-invalid @enderror"
        >
 
        @error('name')
            <p class="invalid-feedback">{{ $errors->first('name') }}</p>
        @enderror
    </div>
 
    <div class="mb-3">
        <label for="band-member" class="form-label">Founder</label>
 
        <select
            id="band-member"
            name="member_id"
            class="form-select @error('member_id') is-invalid @enderror"
        >
            <option value="">Choose founder!</option>
                @foreach($members as $member)
                    <option
                        value="{{ $member->id }}"
                        @if ($member->id == old('member_id', $band->member->id ?? false)) selected @endif
                    >{{ $member->name }}</option>
                @endforeach
        </select>
 
        @error('member_id')
            <p class="invalid-feedback">{{ $errors->first('member_id') }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="band-genre" class="form-label">Genre</label>
 
        <input
            type="text"
            id="band-genre"
            name="genre"
            value="{{ old('genre', $band->genre) }}"
            class="form-control @error('genre') is-invalid @enderror"
        >
 
        @error('genre')
            <p class="invalid-feedback">{{ $errors->first('genre') }}</p>
        @enderror
    </div>
 
    <div class="mb-3">
        <label for="band-description" class="form-label">Description</label>
 
        <textarea
            id="band-description"
            name="description"
            class="form-control @error('description') is-invalid @enderror"
        >{{ old('description', $band->description) }}</textarea>
 
        @error('description')
            <p class="invalid-feedback">{{ $errors->first('description') }}</p>
        @enderror
    </div>
 
    <div class="mb-3">
        <label for="band-year" class="form-label">Formed year</label>
 
        <input
            type="number" max="{{ date('Y') + 1 }}" step="1"
            id="band-year"
            name="formed_year"
            value="{{ old('formed_year', $band->formed_year) }}"
            class="form-control @error('formed_year') is-invalid @enderror"
        >
 
        @error('formed_year')
            <p class="invalid-feedback">{{ $errors->first('formed_year') }}</p>
        @enderror
    </div>
 
    <div class="mb-3">
        <label for="band-image" class="form-label">Image</label>
    
        @if ($band->image)
            <img
                src="{{ asset('images/' . $band->image) }}"
                class="img-fluid img-thumbnail d-block mb-2"
                alt="{{ $band->name }}"
            >
        @endif
    
        <input
            type="file" accept="image/png, image/jpeg, image/webp"
            id="band-image"
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
                id="band-display"
                name="display"
                value="1"
                class="form-check-input @error('display') is-invalid @enderror"
                @if (old('display', $band->display)) checked @endif
            >
            <label class="form-check-label" for="band-display">
                Publicēt ierakstu
            </label>
 
            @error('display')
                <p class="invalid-feedback">{{ $errors->first('display') }}</p>
            @enderror
        </div>
    </div>
 
    <button type="submit" class="btn btn-primary">
        {{ $band->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}
    </button>
</form>
 
@endsection

