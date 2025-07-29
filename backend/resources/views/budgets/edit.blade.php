@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Editar Presupuesto</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('budgets.update', $budget) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="month" class="form-label">Mes</label>
      <input type="month" name="month" id="month" class="form-control" required value="{{ old('month', \Carbon\Carbon::parse($budget->month)->format('Y-m')) }}">
    </div>

    <div class="mb-3">
      <label for="limit" class="form-label">Límite</label>
      <input type="number" name="limit" id="limit" class="form-control" required value="{{ old('limit', $budget->limit) }}">
    </div>

    <div class="mb-3">
      <label for="category_id" class="form-label">Categoría</label>
      <select name="category_id" id="category_id" class="form-select" required>
        <option disabled>--Seleccione una categoría--</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" @if($budget->category_id == $category->id) selected @endif>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('budgets.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form[action="{{ route('budgets.update', $budget) }}"]');

  form.addEventListener('submit', (e) => {
    let errors = [];

    const month = document.getElementById('month').value;
    const limit = document.getElementById('limit').value.trim();
    const category = document.getElementById('category_id').value;

    if (!month) {
      errors.push('Selecciona un mes válido.');
    }

    if (limit === '' || isNaN(limit) || parseFloat(limit) < 0) {
      errors.push('Ingresa un límite válido (mayor o igual a 0).');
    }

    if (!category) {
      errors.push('Selecciona una categoría.');
    }

    if (errors.length > 0) {
      e.preventDefault();
      alert(errors.join('\n'));
    }
  });
});
</script>
@endsection


