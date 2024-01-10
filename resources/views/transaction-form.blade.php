@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Transaction Form</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="from_user_id">From User:</label>
                <select name="from_user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="to_user_id">To User:</label>
                <select name="to_user_id" class="form-control" required>
                    @foreach($users as $user)
                        @if($user->id != old('from_user_id')) {{-- Exclude the "From User" --}}
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" step="0.01" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="currency">Currency:</label>
                <input type="text" name="currency" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Transaction</button>
        </form>
    </div>
@endsection

