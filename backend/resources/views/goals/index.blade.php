@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-plus-circle me-2"></i> Agregar nueva meta financiera
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

          <form id="goalForm" action="{{ route('goals.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nombre de la meta</label>
              <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-3">
              <label for="target_amount" class="form-label">Monto objetivo</label>
              <input type="number" class="form-control" name="target_amount" id="target_amount" min="0" step="0.01" required>
            </div>

            <div class="mb-3">
              <label for="saved_amount" class="form-label">Monto ahorrado</label>
              <input type="number" class="form-control" name="saved_amount" id="saved_amount" min="0" step="0.01" required>
            </div>

            <div class="mb-3">
              <label for="deadline" class="form-label">Fecha límite</label>
              <input type="date" class="form-control" name="deadline" id="deadline" required>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-lg me-2"></i> Agregar meta
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <div class="bg-success text-white p-2 rounded-top d-flex align-items-center">
        <i class="bi bi-list-ul me-2"></i>
        <strong>Total de metas: {{ $goals->count() }}</strong>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Nombre</th>
              <th>Monto objetivo</th>
              <th>Monto ahorrado</th>
              <th>Fecha límite</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($goals as $goal)
              <tr>
                <td>{{ $goal->name }}</td>
                <td>${{ number_format($goal->target_amount, 2) }}</td>
                <td>${{ number_format($goal->saved_amount, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($goal->deadline)->format('d/m/Y') }}</td>
                <td>
                  <a href="{{ route('goals.edit', $goal) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('goals.destroy', $goal) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta meta?');">
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
                <td colspan="5" class="text-center">No tienes metas registradas aún.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('goalForm').addEventListener('submit', function(event) {
  const name = document.getElementById('name').value.trim();
  const target = parseFloat(document.getElementById('target_amount').value);
  const saved = parseFloat(document.getElementById('saved_amount').value);
  const deadline = document.getElementById('deadline').value;

  let errors = [];

  if (name === '') {
    errors.push('El nombre de la meta es obligatorio.');
  }

  if (isNaN(target) || target < 0) {
    errors.push('El monto objetivo debe ser mayor o igual a 0.');
  }

  if (isNaN(saved) || saved < 0) {
    errors.push('El monto ahorrado debe ser mayor o igual a 0.');
  }

  if (!deadline) {
    errors.push('La fecha límite es obligatoria.');
  }

  
  const oldErrors = document.getElementById('client-validation-errors');
  if (oldErrors) oldErrors.remove();

  if (errors.length > 0) {
    event.preventDefault();

    const errorDiv = document.createElement('div');
    errorDiv.classList.add('alert', 'alert-danger');
    errorDiv.id = 'client-validation-errors';

    const ul = document.createElement('ul');
    errors.forEach((error) => {
      const li = document.createElement('li');
      li.textContent = error;
      ul.appendChild(li);
    });
    errorDiv.appendChild(ul);

    this.parentNode.insertBefore(errorDiv, this);
  }
});
</script>
@endsection




