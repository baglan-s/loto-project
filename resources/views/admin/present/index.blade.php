@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Список</h2>
                    <a href="{{ route('present.create') }}" class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>
                        Добавить приз
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
                                <th>Категория</th>
                                <th>Общее количество</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($presents))
                                @foreach($presents as $present)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $present->name }}
                                        </td>
                                        <td>{{ $present->category->name }}</td>
                                        <td>{{ $present->amount }}</td>
                                        <td>
                                            <a href="{{ route('present.edit', $present->id) }}" class="btn-sm btn-primary">Изменить</a>
                                            <form action="{{ route('present.destroy', $present->id) }}" method="post" class="d-inline">
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