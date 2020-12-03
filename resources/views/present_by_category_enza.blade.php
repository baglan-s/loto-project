@extends('layouts.default')

@section('content')

    <div class="presentByCategoryWrapper d-flex flex-column justify-content-between">
        <div class="container myCustomContainer">
            <div class="row">
                <div class="col-sm-2">
                    <div class="logo mt-4"><img src="/images/home_logo.png" alt=""></div>
                </div>
                <div class="col-sm-10">
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
                                @if (!empty($msg))
                                    <div class="alert alert-primary" role="alert">
                                        {!! $msg !!}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-lg btn-primary playOut"><strong>ИТОГИ</strong></button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="result-wrapper">
                        <table class="resultTable">
                            <thead>
                                <tr>
                                    <th class="first-col first-th">Ф.И.О.</th>
                                    @if (isset($result[0]) && isset($result[0]['card_number']))
                                        <th class="second-col second-th">БОНУСТЫҚ КАРТА НӨМІРІ</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @if (!empty($result))
                                @foreach ($result as $participant)
                                    <tr>
                                        <td class="first-col first-users">{{ $participant['name'] }}</td>
                                        <td class="second-col second-users">{{ $participant['card_number'] ?? '' }} <i class="star-icon-font fas fa-star"></i> </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="first-col first-users"></td>
                                    <td class="second-col second-users"> <i class="star-icon-font fas fa-star"></i> </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="sign">
                            <div class="partners">
                                <img src="/images/footer1.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="sign d-flex justify-content-end">
                            <a href="https://homecomfort.kz">homecomfort.kz</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <img class="chair-right" src="/images/chair-right.png" alt="">
{{--        <img class="home-present" src="/images/home-present.png" alt="">--}}

    </div>

@endsection