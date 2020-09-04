@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Результаты розыгрыша</h2>
                    <a href="{{ route('result.reset') }}" class="au-btn au-btn-icon au-btn--blue2">
                        <i class="zmdi zmdi-plus"></i>
                        Сбросить результаты
                    </a>
                </div>
                @component('components.alert')@endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination mt-5">
                    @if ($results->count())
                        {{ $results->links() }}
                    @endif
                </div>
                <div class="table-responsive table--no-card m-b-40 m-t-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Ф.И.О.</th>
                            <th>Телефон</th>
                            <th>Номер карты</th>
                            <th>Город</th>
                            <th>Приз</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($results))
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->participant->name }}</td>
                                    <td>{{ $result->participant->phone }}</td>
                                    <td>{{ $result->participant->card_number }}</td>
                                    <td>{{ $result->participant->city->name }}</td>
                                    <td>{{ $result->present->name }}</td>
                                    <td>
                                        <form action="{{ route('result.destroy', $result->id) }}" method="post" class="d-inline">
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