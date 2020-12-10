@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('deposit.create')}}" class="btn-primary btn">Create deposit</a>
                @if(count($deposits))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Invested</th>
                            <th>Percent</th>
                            <th>Accrue times</th>
                            <th>Accrued amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deposits as $item)
                            <tr>
                                <td>{{$item->deposit_id}}</td>
                                <td>{{$item->invested}}</td>
                                <td>{{$item->percent}}</td>
                                <td>{{$item->accrue_times}}</td>
                                <td>{{$item->amount_of_accrue}}</td>
                                <td>{{$item->active}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h2>There are no deposits for this moment</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
