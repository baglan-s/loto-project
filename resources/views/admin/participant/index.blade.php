@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Список</h2>
                    <div class="actions d-flex align-items-center">
                        <button type="button" class="btn btn-secondary mr-1" data-toggle="modal" data-target="#mediumModal">Импорт</button>
                        <a href="{{ route('participant.create') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>
                            Добавить участника
                        </a>
                    </div>
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
                                <th>Ф.И.О.</th>
                                <th>Телефон</th>
                                <th>Номер карты</th>
                                <th>Город</th>
                                <th>Шансы</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($participants))
                                @foreach($participants as $participant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
{{--                                            <a href="{{ route('participant.show', $participant->id) }}">{{ $participant->name }}</a>--}}
                                            <span>{{ $participant->name ?? '' }}</span>
                                        </td>
                                        <td>{{ $participant->phone ?? '' }}</td>
                                        <td>{{ $participant->card_number ?? '' }}</td>
                                        <td>{{ $participant->city->name ?? '' }}</td>
                                        <td>{{ $participant->chance ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('participant.edit', $participant->id) }}" class="btn-sm btn-primary">Изменить</a>
                                            <form action="{{ route('participant.destroy', $participant->id) }}" method="post" class="d-inline">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn-sm btn-danger">Удалить</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $participants->links() }}
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection