@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @component('components.alert')@endcomponent
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong class="card-title">{{ $region->name }}</strong>
                        <a href="{{ route('region.index') }}" class="btn btn-sm btn-danger">Назад</a>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border">
                                        <div class="card-header">
                                            <p class="card-text">Список городов региона:</p>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @if ($region->cities->count())
                                                    @foreach($region->cities as $city)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <a href="{{ route('city.show', $city->id) }}">
                                                                <span>{{ $city->name }}</span>
                                                            </a>
                                                            <form action="{{ route('region.delete-city', [$region->id, $city->id]) }}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn btn-sm btn-danger">Удалить город</button>
                                                            </form>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="list-group-item">
                                                        В данном регионе пока нет городов
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection