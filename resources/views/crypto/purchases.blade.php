<!-- resources/views/crypto/purchases.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Crypto Purchases') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(isset($purchases))
                        @if($purchases->isEmpty())
                            <p class="text-gray-500">You haven't purchased any cryptocurrencies yet.</p>
                        @else
                            <h3 class="text-lg font-semibold mb-4">My Crypto Purchases:</h3>
                            <ul>
                                @foreach($purchases->reverse() as $purchase)
                                    <li>
                                        <p class="mb-2"><strong>Crypto Symbol:</strong> {{ $purchase->crypto_symbol }}</p>
                                        <p class="mb-2"><strong>Amount:</strong> {{ $purchase->purchase_price }}</p>
                                        <p class="mb-2"><strong>Currency:</strong> {{ $purchase->currency }}</p>
                                        <p class="mb-2"><strong>Real Time Price:</strong> {{ $purchase->real_time_price }}</p>

                                        <p class="mb-2"><strong>Purchased At:</strong> {{ $purchase->created_at }}</p>

                                        @php
                                            $priceChangePercentage = $purchase->calculatePriceChangePercentage();
                                            $colorClass = $priceChangePercentage < 0 ? 'text-red' : 'text-green';
                                        @endphp

                                        <p class="mb-2"><strong>Price Change Percentage:</strong> <span class="{{ $colorClass }}">{{ $priceChangePercentage }}%</span></p>

                                        <hr class="my-4">
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @else
                        <p class="text-gray-500">Unable to retrieve your purchases at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
