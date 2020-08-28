@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Список</h2>
                    <a href="{{ route('region.create') }}" class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>
                        Добавить регион
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
                                <th>Количество городов</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($regions))
                                @foreach($regions as $region)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('region.show', $region->id) }}">{{ $region->name }}</a>
                                        </td>
                                        <td>{{ $region->cities->count() }}</td>
                                        <td>
                                            <a href="{{ route('region.edit', $region->id) }}" class="btn-sm btn-primary">Изменить</a>
                                            <form action="{{ route('region.destroy', $region->id) }}" method="post" class="d-inline">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn-sm btn-danger">Удалить</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection