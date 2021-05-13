@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Личный кабинет') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Ваш ID</th>
                            <td>{{Auth::user()->id}}</td>
                        </tr>
                        <tr>
                            <th>Роль</th>
                            <td>{{$user->role->name}}</td>
                        </tr>
                        <tr>
                            <th>ФИО</th>
                            <td>{{Auth::user()->last_name}} {{Auth::user()->first_name}} {{Auth::user()->patronymic}}</td>
                        </tr>
                        <tr>
                            <th>Номер телефона</th>
                            <td>{{Auth::user()->phone}}</td>
                        </tr>
                        </tbody>
                    </table>
                    @if($user->role->id == 1)
                        <div class="container mb-4">
                            <div class="row justify-content-center">
                                <button class="btn btn-secondary col-12"> Подать заявку на изменение данных</button>
                            </div>
                        </div>
                    @elseif($user->role->id == 2)
                        <div class="container mb-4">
                            <div class="row justify-content-center">
                                <button class="btn btn-secondary col-md-5 mb-md-0"> Подать заявку на изменение данных</button>
                                <button class="btn btn-secondary col-md-5 offset-md-1"> Посмотреть аккаунты</button>
                            </div>
                        </div>
                        @elseif($user->role->id == 3)
                            <div class="container mb-4">
                                <div class="row justify-content-center">
                                    <button class="btn btn-secondary col-md-5 mb-md-0 col-sm-5 "> Посмотреть заявки на изменение данных</button>
                                    <button class="btn btn-secondary col-md-5 offset-md-1 col-sm-5 offset-sm-1"> Посмотреть аккаунты</button>
                                </div>
                            </div>
                    @endif

                    <div class="card-header">{{ __('Взятые книги') }}</div>
                    <table class="table table-responsive-sm table-responsive-md table-striped tablesorter">
                        <thead>
                        <tr>
                            <th scope="col-1">ID книги</th>
                            <th scope="col-2">Название</th>
                            <th scope="col-2">Автор</th>
                            <th scope="col-2">Дней осталось</th>
                            <th scope="col-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td><button class="btn btn-info">Подробнее</button></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td><button class="btn btn-info">Подробнее</button></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                            <td><button class="btn btn-info">Подробнее</button></td>
                        </tr>
                        </tbody>
                    </table>

                    <button class="btn btn-primary col-12">Посмотреть историю взятых книг</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
