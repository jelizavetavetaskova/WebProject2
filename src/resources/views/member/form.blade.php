@extends('layout')
 
@section('content')
 
    <h1>{{ $title }}</h1>
 
    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif
    

    <form method="post" action="{{ $member->exists ? '/members/patch/' . $member->id : '/members/put' }}">
        @csrf
 
        <div class="mb-3">
            <label for="member-name" class="form-label">Dalībnieka vārds</label>
 
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="member-name" 
                name="name"
                value="{{ old('name', $member->name) }}"
            >
 
            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
 
        </div>
 
        <button type="submit" class="btn btn-primary">{{ $member->exists ? "Rediģēt" : "Pievienot" }}</button>
 
    </form>
 
@endsection