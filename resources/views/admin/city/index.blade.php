@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Список</h2>
                    <a href="{{ route('city.create') }}" class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>
                        Добавить город
                    </a>
                </div>
                @component('components.alert')@endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-40 m-t-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Название</th>
                                <th>Регион</th>
                                <th class="text-center">Количество участников</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($cities))
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $city->name }}</td>
                                        <td>{!! $city->region->name ?? '<span style="color: red;">На назначено</span>' !!}</td>
                                        <td class="text-center">{{ $city->participants->count() }}</td>
                                        <td>
                                            <a href="{{ route('city.edit', $city->id) }}" class="btn-sm btn-primary">Изменить</a>
                                            <form action="{{ route('city.destroy', $city->id) }}" method="post" class="d-inline">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn-sm btn-danger">Удалить</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Нет городов</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection