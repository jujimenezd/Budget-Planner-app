<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Transacciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h3 class="mb-4">Reporte de Transacciones por Categoría</h3>

        @foreach ($transactions as $category => $items)
            <h5 class="mt-4">Categoría: {{ $category }}</h5>
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $transaction)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</td>
                            <td>{{ $transaction->type ? 'Ingreso' : 'Gasto' }}</td>
                            <td>${{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ $transaction->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</body>
</html>
