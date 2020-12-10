@extends('layouts.default')

@section('content')

    <div class="presentByCategoryWrapper">
        <div class="container myCustomContainer">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo mt-5"><img src="/images/logo2.png" alt=""></div>
                </div>
                <div class="col-sm-1">
                    <div class="title-wrapper mt-5">
                        <h3 class="presentByCategoryTitle"><strong>САНАТ</strong></h3>
                    </div>
                </div>
                <div class="col-sm-8">
                    <form method="post" class="mt-5">
                        {{ csrf_field() }}
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4">
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
                                <div class="wrapperPromoName">
{{--                                    <img class="wrapperPromoNameImg" src="/images/promo-name2.png" alt="">--}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-lg btn-primary playOut"><strong>РАЗЫГРАТЬ</strong></button>
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
                                    <th class="first-col first-th">АТЫ-ЖӨНІ</th>
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
                                        @if (isset($participant['card_number']))
                                            <td class="second-col second-users">{{ $participant['card_number'] }} <img class="star-icon" src="/images/star.svg" alt=""> </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="first-col first-users"></td>
                                    <td class="second-col second-users"> <img class="star-icon" src="/images/star.svg" alt=""> </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="siteUrl">
                <a href="https://evrika.com" title="Интернет - магазин Evrika" target="_blank"><strong>EVRIKA.COM</strong></a>
            </div>
        </div>
    </div>

@endsection