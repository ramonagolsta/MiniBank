<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buy Crypto!') }}
        </h2>
    </x-slot>

    <div class="mt-4 text-right mb-4">
        <form method="post" action="{{ route('crypto.buycrypto') }}">
            @csrf
            <button type="submit" class="create-investment-btn">
                Buy Crypto
            </button>
        </form>
    </div>
</x-app-layout>


