<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        My accounts
                    </h2>

                    @if(!$accounts->isEmpty())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bank Account Number
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Balance
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Currency
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($accounts as $account)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $account->bank_account_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ number_format($account->balance / 100, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $account->currency }}
                                    </td>
                                    <!-- New Buttons -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('transactions.create', ['from_account' => $account->bank_account_number, 'balance' => $account->balance, 'currency' => $account->currency]) }}" class="text-indigo-600 hover:text-indigo-900">New Transaction</a>

                                        <a href="{{ route('transactions.history', ['account' => $account->bank_account_number]) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Transaction History</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-600">No accounts found.</p>
                        <div class="mt-4 text-right mb-4">
                            <a href="{{ route('account.create') }}" class="create-investment-btn">
                                Create Account
                            </a>
                        </div>
                    @endif
                </div>
            </div><br>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        My investment accounts
                    </h2>
                    @if($investmentAccounts)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Investment Account Number
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Balance
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Currency
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $investmentAccounts->bank_account_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ number_format($investmentAccounts->balance / 100, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $investmentAccounts->currency }}
                                </td>
                                <!-- New Buttons -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('transactions.create', ['from_account' => $investmentAccounts->bank_account_number]) }}" class="text-indigo-600 hover:text-indigo-900">New Transaction</a>
                                    <a href="{{ route('transactions.history', ['account' => $investmentAccounts->bank_account_number]) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Transaction History</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-600">No investment accounts found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

