@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-plus-circle me-2"></i> Agregar nuevo presupuesto
        </div>
        <div class="card-body">
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div id="client-errors"></div>
          <form action="{{ route('budgets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="month" class="form-label">Mes</label>
              <input type="month" class="form-control" name="month" id="month" required>
            </div>

            <div class="mb-3">
              <label for="limit" class="form-label">Límite de presupuesto</label>
              <input type="number" class="form-control" name="limit" id="limit" step="0.01" required>
            </div>

            <div class="mb-3">
              <label for="category_id" class="form-label">Categoría</label>
              <select class="form-select" name="category_id" id="category_id" required>
                <option selected disabled>--Seleccione una categoría--</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="d-flex justify-content-start gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-lg me-5"></i> Agregar presupuesto
              </button>
          </form>
              <form action="{{ route('report.budgets.pdf') }}" method="GET" class="d-flex align-items-center gap-2 mb-3">
                <input type="month" name="month" class="form-control w-auto" required>
                <button type="submit" class="btn btn-primary btn-sm">Descargar Reporte(elija un mes)</button>
              </form>
            </div>          
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <div class="bg-success text-white p-2 rounded-top d-flex align-items-center">
        <i class="bi bi-list-ul me-2"></i>
        <strong>Total de presupuestos: {{ $budgets->count() }}</strong>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Mes</th>
              <th>Límite</th>
              <th>Categoría</th>
              <th>Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($budgets as $budget)
              <tr>
                <td>{{ \Carbon\Carbon::parse($budget->month)->format('Y-m') }}</td>
                <td>${{ number_format($budget->limit, 2) }}</td>
                <td>{{ $budget->category->name }}</td>
                <td>{{ $budget->user->name }}</td>
                <td>
                  <a href="{{ route('budgets.edit', $budget) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('budgets.destroy', $budget) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este presupuesto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">No tienes presupuestos registrados aún.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form[action="{{ route('budgets.store') }}"]');
  const errorContainer = document.getElementById('client-errors');

  form.addEventListener('submit', (e) => {
    errorContainer.innerHTML = '';
    let errors = [];

    const month = document.getElementById('month').value;
    const limit = document.getElementById('limit').value.trim();
    const category = document.getElementById('category_id').value;

    if (!month) {
      errors.push('Por favor selecciona un mes válido.');
    }

    if (limit === '' || isNaN(limit) || parseFloat(limit) < 0) {
      errors.push('Por favor ingresa un límite válido (mayor o igual a 0).');
    }

    if (!category) {
      errors.push('Por favor selecciona una categoría.');
    }

    if (errors.length > 0) {
      e.preventDefault();

      const alertDiv = document.createElement('div');
      alertDiv.classList.add('alert', 'alert-danger');
      alertDiv.innerHTML = `
        <strong>Existen errores:</strong>
        <ul class="mb-0">
          ${errors.map(err => `<li>${err}</li>`).join('')}
        </ul>
      `;
      errorContainer.appendChild(alertDiv);
    }
  });
});
</script>
@endsection



