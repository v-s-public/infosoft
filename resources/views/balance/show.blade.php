@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Hello! Your balance for this moment: {{$balance}}</h2>
            <a href="{{route('balance.form')}}" class="btn-primary btn">Top up balance</a>
        </div>
    </div>
@endsection
