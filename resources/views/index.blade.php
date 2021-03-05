@extends('layouts.default')

@section('content')

    <div class="wrapper" style="background-image: url({{ asset($setting->main_image) }})">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form action="" class="mt-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="" id="category" class="form-control mb-4">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-lg btn-primary category-btn" type="button">Выбрать</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection