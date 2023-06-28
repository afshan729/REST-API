<!-- resources/views/invoices/index.blade.php -->
    <form action="{{ route('invoices.index') }}" method="GET">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" value="{{ request('customer_name') }}">
        <label for="salesperson">Salesperson:</label>
        <input type="text" name="salesperson" value="{{ request('salesperson') }}">
        <label for="photographer">Photographer:</label>
        <input type="text" name="photographer" value="{{ request('photographer') }}">
        <button type="submit">Apply Filter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Salesperson</th>
                <th>Photographer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->customer_name }}</td>
                    <td>{{ $invoice->salesperson }}</td>
                    <td>{{ $invoice->photographer }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
