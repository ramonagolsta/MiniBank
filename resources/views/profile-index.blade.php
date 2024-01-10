
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>User Profile</h2>

        <a href="{{ route('transaction.create') }}">Make a Transaction</a>
        <h2>
            <a href="{{ ('make-transaction') }}" method="POST">Make a Transaction!!!</a>

        </h2>

    </div>
@endsection
