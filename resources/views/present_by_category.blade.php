@extends('layouts.default')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form method="post" class="mt-5">
                    {{ csrf_field() }}
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="present_id" id="category" class="form-control mb-4">
                                    @foreach($present_category->presents as $present)
                                        <option value="{{ $present->id }}" @if(request()->post('present_id') == $present->id) selected @endif>{{ $present->name }} ({{ $present->regions()->first()->getPresentsAmount($present->id) }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button class="btn btn-lg btn-primary">Разыграть</button>
                            </div>
                            @if (!empty($msg))
                                <div class="alert alert-primary" role="alert">
                                    {{ $msg }}
                                </div>
                            @endif
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection