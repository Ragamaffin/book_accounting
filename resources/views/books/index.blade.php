@extends('layouts.app')

@section('content')
    @foreach($books as $book)
        <div class="container">
            <div class="row">
                <span>{{$book->name}}</span>
            </div>
        </div>
    @endforeach
@endsection
