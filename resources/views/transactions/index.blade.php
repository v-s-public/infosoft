@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Transactions</h2>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $item)
                        <tr>
                            <td>{{$item->transaction_id}}</td>
                            <td>{{$item->type}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
@endsection
