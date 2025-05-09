
@extends('layout')
 
@section('content')
    
    <h1>{{ $title }}</h1>
    
    @if (count($items) > 0)
    
        <table class="table table-sm table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Founder</th>
                    <th>Genre</th>
                    <th>Formed year</th>
                    <th>Description</th>
                    <th>Display</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
    
            @foreach($items as $band)
                <tr>
                    <td>{{ $band->id }}</td>
                    <td>{{ $band->name }}</td>
                    <td>{{ $band->member->name }}</td>
                    <td>{{ $band->genre }}</td>
                    <td>{{ $band->formed_year }}</td>
                    <td>{{ $band->description }}</td>
                    <td>{!! $band->display ? '&#x2714;' : '&#x274C;' !!}</td>
                    <td>
                        <a 
                            href="/bands/update/{{ $band->id }}" 
                            class="btn btn-outline-primary btn-sm"
                        >Edit</a> /
                        <form 
                            method="post" 
                            action="/bands/delete/{{ $band->id }}" 
                            class="d-inline deletion-form"
                        >
                            @csrf
                            <button 
                                type="submit" 
                                class="btn btn-outline-danger btn-sm"
                            >Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    
            </tbody>
        </table>
    
    @else
        <p>Empty table</p>
    @endif
    
    <a href="/bands/create" class="btn btn-primary">Pievienot jaunu</a>
 
@endsection

