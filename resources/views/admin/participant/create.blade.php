@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap m-b-40">
                    <h2 class="title-1">Добавление нового участника</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Заполните</strong> данные участника
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('participant.store') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 col">
                                    <div class="form-group">
                                        <label for="hf-name" class=" form-control-label">Ф.И.О.</label>
                                        <input type="text" id="hf-name" name="name" placeholder="Ф.И.О." class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col">
                                    <div class="form-group">
                                        <label for="hf-phone" class=" form-control-label">Телефон</label>
                                        <input type="text" id="hf-phone" name="phone" placeholder="Телефон" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col">
                                    <div class="form-group">
                                        <label for="hf-card-number" class=" form-control-label">Номер карты</label>
                                        <input type="number" id="hf-card-number" name="card_number" placeholder="Номер карты" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col">
                                    <div class="form-group">
                                        <label for="hf-card-number" class=" form-control-label">Количество шансов</label>
                                        <input type="number" id="hf-card-number" name="chance" placeholder="Количество шансов" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6 col">
                                    <div class="form-group">
                                        <label for="hf-city" class=" form-control-label">Город</label>
                                        <select name="city_id" id="hf-city" class="form-control">
                                            @if (!empty($cities))
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button onclick="document.querySelector('.form-horizontal').submit()" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Сохранить
                        </button>
                        <a href="{{ route('participant.index') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Отменить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection