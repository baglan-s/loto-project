@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap m-b-40">
                    <h2 class="title-1">Изменение настроек</h2>
                </div>

                @component('components.alert')@endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Изменение текущих настроек
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('setting.update', $setting->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="hf-name" class=" form-control-label">Главный фон</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="image_edit d-flex flex-column align-items-start">
                                        <button id="img_change" type="button">
                                            <img src="{{ asset($setting->main_image) }}" alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button onclick="document.querySelector('.form-horizontal').submit()" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Сохранить
                        </button>
                        <a href="{{ url('/admin') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Отменить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .image_edit img {
            width: 200px;
            height: auto;
        }
        #img_change {
            outline: none;
            border: none;
            cursor: pointer;
            background-color: transparent;
            margin-bottom: 10px;
        }
    </style>

@endsection