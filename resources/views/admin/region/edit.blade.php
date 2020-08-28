@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap m-b-40">
                    <h2 class="title-1">Изменение региона <b>{{ $region->name }}</b></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Заполните</strong> данные региона
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('region.update', $region->id) }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="hf-name" class=" form-control-label">Название</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="hf-name" name="name" placeholder="Название региона" class="form-control" value="{{ $region->name ?? '' }}" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button onclick="document.querySelector('.form-horizontal').submit()" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Сохранить
                        </button>
                        <a href="{{ route('region.index') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Отменить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection