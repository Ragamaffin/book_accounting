@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Добавить кол-во существующей книги') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('books.addCount', $book) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="book_name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Название книги') }}</label>

                            <div class="col-md-6">
                                <input id="book_name" type="text"
                                       class="form-control @error('book_name') is-invalid @enderror"
                                       name="book_name" value="{{ $book->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Автор') }}</label>

                            <div class="col-md-6">
                                <input id="author" type="text"
                                       class="form-control @error('author') is-invalid @enderror" name="author"
                                       value="{{ $book->author }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Год') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="text"
                                       class="form-control @error('year') is-invalid @enderror" name="year"
                                       value="{{ $book->year }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>

                            <div class="col-md-6">
                                    <textarea id="description" rows="5"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" disabled>{{ $book->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="count" class="col-md-4 col-form-label text-md-right">{{ __('Количество') }}</label>

                            <div class="col-md-6">
                                <input id="count" type="number"
                                       class="form-control @error('count') is-invalid @enderror" name="count"
                                       value="{{ old('count') }}" required max="100">

                                @error('count')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Добавить книгу') }}
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
