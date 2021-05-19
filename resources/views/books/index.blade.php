@extends('layouts.app')

@section('content')
    <div class="album py-2 bg-light">
        <div class="container">
            <div class="card card-header mb-1">
                <div class="row">
                    <div class="col-md-2 mb-sm-2 mb-md-0">
                        @if($user->role_id >= 2)
                            <a href="{{ route('books.create') }}" class="btn btn-primary">Добавить книгу</a>
                        @endif
                    </div>
{{--                    <div class="col-md-2">--}}
{{--                        <select class="form-control" aria-label="Default select example" id="genre"--}}
{{--                                name="genre">--}}
{{--                            @foreach($genres as $genre)--}}
{{--                                <option value="{{$genre->id}}"--}}
{{--                                        @if($genre->id == old('genre')) selected="selected"@endif>{{$genre->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-2 mt-sm-2 mt-md-0 mb-sm-2 mb-md-0">--}}
{{--                        <button type="submit" class="btn btn-primary">Фильтр по жанру</button>--}}
{{--                    </div>--}}
                    <div class="offset-4 col-md-6">
                        <form action="{{ route('books.index') }}" method="get" class="form-inline justify-content-end">
                            <input name="search" id="search" class="form-control col-9" type="text" placeholder="Search" aria-label="Search" >
                            <button type="submit" class="btn btn-primary form-group ml-1">Поиск</button>
                        </form>
                    </div>
{{--                    <div class="col-1">--}}
{{--                        <button type="submit" class="btn btn-primary">Поиск</button>--}}
{{--                    </div>--}}

                </div>
            </div>

            @if(count($books) > 0)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($books as $book)
                        <div class="col mb-3">
                            <div class="card shadow-sm">
                                <div class="image-container">
                                    <img src="{{ $book->getImagePath() }}" alt="" class="d-block w-100">
                                </div>

                                <div class="card-body">
                                    <p class="card-text">Название: {{$book->name}}</p>
                                    <p class="card-text">Автор: {{$book->author}}</p>
                                    <p class="card-text">Год: {{$book->year}}</p>
                                    @if($user->role_id >= 2)
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                            <a href="{{ route('books.showAddCount', $book) }}" class="btn btn-sm btn-outline-success">Добавить кол-во</a>
                                            <button type="button" class="btn btn-sm btn-outline-primary">Читатели</button>
                                        </div>
                                    @endif
                                    <div class="mt-2">
                                        <small class="text-muted">Доступно: {{ $book->similar_books_count }}</small>
                                        @if($user->role_id >= 2)
                                            <small class="text-muted ml-2">Всего: {{ count($book->similarBooks) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center h1 mt-4">Книг с таким названием не найдено</div>
            @endif

        </div>
    </div>
@endsection
