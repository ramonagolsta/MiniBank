<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction history for account: ') . request()->query('account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sent amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Received amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Received From
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sent To
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $transaction->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $transaction->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($transaction->from_account == $bankAccountNumber)
                                         {{ number_format($transaction->sent_amount / 100, 2) }} {{ $transaction->sent_currency }}
                                        <br>
                                        @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($transaction->to_account == $bankAccountNumber)
                                         {{ number_format($transaction->received_amount / 100, 2) }} {{ $transaction->received_currency }}
                                        <br>
                                        @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($transaction->from_account !== $bankAccountNumber)
                                         {{ $transaction->from_account }}
                                        <br>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($transaction->to_account !== $bankAccountNumber)
                                        {{ $transaction->to_account }}
                                        <br>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>


                        <tfoot class="bg-gray-100">
                        <tr>
                            <th colspan="2" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total:
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ number_format($totalSent / 100, 2) }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ number_format($totalReceived / 100, 2) }}
                            </th>
                        </tr>
                        </tfoot>

                    </table>

                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>