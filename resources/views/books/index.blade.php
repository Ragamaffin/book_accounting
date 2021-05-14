@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row justify-content-center">
                @foreach($books as $book)
                    <span class="col-2 text-center">{{$book->name}}</span>
                @endforeach
            </div>
        </div>
@endsection
