@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap m-b-40">
                    <h2 class="title-1">Изменение города {{ $city->name }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Заполните</strong> данные города
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('city.update', $city->id) }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="form-group col col-md-6">
                                    <label for="hf-name" class=" form-control-label">Название</label>
                                    <input type="text" id="hf-name" name="name" placeholder="Название города" class="form-control" value="{{ $city->name }}" required>
                                </div>
                                <div class="form-group col col-md-6">
                                    <label for="hf-region" class=" form-control-label">Выберите регион</label>
                                    <select name="region" id="hf-region" class="form-control" required>
                                        @if (!empty($regions))
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}" @if($city->region_id == $region->id) selected @endif>{{ $region->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Нет регионов</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button onclick="document.querySelector('.form-horizontal').submit()" class="btn btn-success btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Сохранить
                        </button>
                        <a href="{{ route('city.index') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Отменить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection