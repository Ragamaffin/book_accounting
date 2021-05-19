@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Изменить информацию о книге') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">

                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="book_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Название книги') }}</label>

                                <div class="col-md-6">
                                    <input id="book_name" type="text"
                                           class="form-control @error('book_name') is-invalid @enderror"
                                           name="book_name" value="{{ $book->name }}" required>

                                    @error('book_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="author"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Автор') }}</label>

                                <div class="col-md-6">
                                    <input id="author" type="text"
                                           class="form-control @error('author') is-invalid @enderror" name="author"
                                           required value="{{ $book->author }}">

                                    @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="form-group row">--}}
{{--                                <label for="genre"--}}
{{--                                       class="col-md-4 col-form-label text-md-right">{{ __('Жанр') }}</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <select class="form-control" aria-label="Default select example" id="genre"--}}
{{--                                            name="genre">--}}
{{--                                        @foreach($genres as $genre)--}}
{{--                                            <option value="{{$genre->id}}"--}}
{{--                                                    @if($genre->id == old('genre')) selected="selected"@endif>{{$genre->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row">
                                <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Год') }}</label>

                                <div class="col-md-6">
                                    <input id="year" type="text"
                                           class="form-control @error('year') is-invalid @enderror" name="year"
                                           value="{{ $book->year }}" required>

                                    @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" rows="5"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" required>{{ $book->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Изображение') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                           class="@error('image') is-invalid @enderror"
                                           name="image" value="{{ $book->image_name }}">
                                    <div class="image-container mt-1">
                                        <img src="{{ $book->getImagePath() }}" alt="" class="d-block w-100">
                                    </div>

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="form-group row">--}}
{{--                                <label for="count" class="col-md-4 col-form-label text-md-right">{{ __('Количество') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="count" type="number"--}}
{{--                                           class="form-control @error('count') is-invalid @enderror" name="count"--}}
{{--                                           value="{{ old('count') }}" required max="100">--}}

{{--                                    @error('count')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Изменить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
