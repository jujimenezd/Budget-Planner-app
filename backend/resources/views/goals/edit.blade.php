@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-pencil me-2"></i> Editar meta financiera
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form id="goalForm" action="{{ route('goals.update', $goal) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="name" class="form-label">Nombre de la meta</label>
              <input type="text" name="name" id="name" class="form-control"
                     value="{{ old('name', $goal->name) }}" required>
            </div>

            <div class="mb-3">
              <label for="target_amount" class="form-label">Monto objetivo</label>
              <input type="number" name="target_amount" id="target_amount" class="form-control" min="0" step="0.01"
                     value="{{ old('target_amount', $goal->target_amount) }}" required>
            </div>

            <div class="mb-3">
              <label for="saved_amount" class="form-label">Monto ahorrado</label>
              <input type="number" name="saved_amount" id="saved_amount" class="form-control" min="0" step="0.01"
                     value="{{ old('saved_amount', $goal->saved_amount) }}" required>
            </div>

            <div class="mb-3">
              <label for="deadline" class="form-label">Fecha límite</label>
              <input type="date" name="deadline" id="deadline" class="form-control"
                     value="{{ old('deadline', $goal->deadline) }}" required>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-save me-2"></i> Actualizar meta
              </button>
              <a href="{{ route('goals.index') }}" class="btn btn-secondary mt-2">
                Cancelar
              </a>
            </div>
          </form>
        </div>
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

  if (!name) errors.push('El nombre de la meta es obligatorio.');
  if (isNaN(target) || target < 0) errors.push('El monto objetivo debe ser un número mayor o igual a 0.');
  if (isNaN(saved) || saved < 0) errors.push('El monto ahorrado debe ser un número mayor o igual a 0.');
  if (!deadline) errors.push('La fecha límite es obligatoria.');

  const existing = document.getElementById('client-validation-errors');
  if (existing) existing.remove();

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

