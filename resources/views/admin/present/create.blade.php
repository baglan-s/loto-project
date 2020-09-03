@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap m-b-40">
                    <h2 class="title-1">Добавление нового приза</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Заполните</strong> данные приза
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('present.store') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="default-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Общие данные</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Количество по регионам</a>
                                    </div>
                                </nav>
                                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                    <div class="tab-pane p-3 fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="row">
                                            <div class="col-md-6 col">
                                                <div class="form-group">
                                                    <label for="hf-name" class=" form-control-label">Название</label>
                                                    <input type="text" id="hf-name" name="name" placeholder="Название приза" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col">
                                                <div class="form-group">
                                                    <label for="hf-amount" class=" form-control-label">Общее количество</label>
                                                    <input type="number" id="hf-amount" name="general_amount" class="form-control" value="0" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col">
                                                <div class="form-group">
                                                    <label for="hf-category" class=" form-control-label">Категория приза</label>
                                                    <select name="category" id="hf-category" class="form-control">
                                                        @if (!empty($present_categories))
                                                            @foreach($present_categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-3 fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        @if (!empty($regions))
                                            <div class="col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    @foreach($regions as $region)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <p>
                                                                <span>{{ $region->name }}</span>
                                                            </p>
                                                            <input type="number" name="region_amount_{{ $region->id }}" class="number-input-visible p-1" style="border: 1px solid #ccc" value="0">
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button onclick="document.querySelector('.form-horizontal').submit()" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Сохранить
                        </button>
                        <a href="{{ route('present.index') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Отменить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection