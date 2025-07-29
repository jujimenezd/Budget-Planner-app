<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Presupuestos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h3 class="mb-4">Reporte de Presupuestos – Mes: {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h3>

        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th>Categoría</th>
                    <th>Presupuesto</th>
                    <th>Gastado</th>
                    <th>Diferencia</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $row)
                    <tr>
                        <td>{{ $row['categoria'] }}</td>
                        <td>${{ number_format($row['presupuesto'], 2) }}</td>
                        <td>${{ number_format($row['gastado'], 2) }}</td>
                        <td>${{ number_format($row['diferencia'], 2) }}</td>
                        <td>
                            @if ($row['diferencia'] < 0)
                                <span class="text-danger">Excedido</span>
                            @else
                                <span class="text-success">OK</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
