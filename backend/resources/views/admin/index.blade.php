@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">

      <div class="table-responsive">
        <h2>Usuarios registrados en la aplicación</h2>
        <table class="table table-striped table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>id</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Creado</th>
              <th>Última modificación</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
              <td class="d-flex gap-4">
                <a href="{{route('admin-panel.edit', $user->id)}}" class="btn btn-primary">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{route('admin-panel.destroy', $user->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <hr class="my-5">
      <h2 class="mt-4 mb-3">Usuarios más activos</h2>
      <p class="text-muted">Número transacciones registradas por usuario</p>

      <div class="card p-4 mb-5 shadow-sm">
        <canvas id="graficoUsuariosActivos" height="100"></canvas>
      </div>

    </div>
  </div>
</div>

<!-- Chart.js desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const nombresTop = {!! json_encode($nombresTop) !!};
  const movimientosTop = {!! json_encode($movimientosTop) !!};

  // Crear el gráfico de barras
  const ctx = document.getElementById('graficoUsuariosActivos').getContext('2d');
  new Chart(ctx, {
      type: 'bar',
      data: {
          labels: nombresTop,
          datasets: [{
              label: 'Número de movimientos',
              data: movimientosTop,
              backgroundColor: [
                  '#007bff', 
                  '#6c757d', 
                  '#17a2b8', 
                  '#343a40', 
                  '#adb5bd'  
              ],
              borderRadius: 5
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: {
                  display: false
              },
              tooltip: {
                  callbacks: {
                      label: function(context) {
                          return context.raw + ' transacciones';
                      }
                  }
              }
          },
          scales: {
              y: {
                  beginAtZero: true,
                  precision: 0,
                  ticks: {
                      stepSize: 1
                  }
              }
          }
      }
  });
</script>
@endsection
