<table style="width: 100%">
    <thead>
        <tr style="background-color: #e6e6e7;">
            <th scope="col">Date</th>
            <th scope="col">Invoice</th>
            <th scope="col">Cashier</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->created_at }}</td>
            <td>{{ $transaction->invoice_code }}</td>
            <td>{{ $transaction->cashier->name }}</td>
            <td class="text-end">{{ number_format($transaction->grand_total, 2, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3" class="text-end fw-bold" style="background-color: #e6e6e7;">TOTAL</td>
            <td class="text-end fw-bold" style="background-color: #e6e6e7;">{{ number_format($total, 2, ',', '.') }}</td>
        </tr>
    </tbody>
</table>