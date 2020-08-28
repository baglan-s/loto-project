@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Список</h2>
                    <a href="{{ route('present-category.create') }}" class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>
                        Добавить категорию
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
                                <th>Количество призов</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($present_categories))
                                @foreach($present_categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('present-category.show', $category->id) }}">{{ $category->name }}</a>
                                        </td>
                                        <td>{{ $category->presents->count() }}</td>
                                        <td>
                                            <a href="{{ route('present-category.edit', $category->id) }}" class="btn-sm btn-primary">Изменить</a>
                                            <form action="{{ route('present-category.destroy', $category->id) }}" method="post" class="d-inline">
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