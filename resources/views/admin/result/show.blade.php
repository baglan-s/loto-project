@extends('layouts.default')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap mt-5">
                    <h2 class="title-1">Результаты розыгрыша</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination mt-5">
                    @if ($results->count())
                        {{ $results->links() }}
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Ф.И.О.</th>
                                <th>Город</th>
                                <th>Приз</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($results))
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->participant->name ?? '' }}</td>
                                    <td>{{ $result->participant->city->name ?? '' }}</td>
                                    <td>{{ $result->present->name ?? '' }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection