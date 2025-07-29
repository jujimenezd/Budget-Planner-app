@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-plus-circle me-2">Modifica tu ingreso o gasto</i>
        </div>
        <div class="card-body">

          <div id="client-validation-errors"></div>

          <form id="editTransactionForm" action="{{route('transactions.update', $transaction->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="description" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="description" id="description"
                  value="{{$transaction->description}}" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="amount" class="form-label">Monto</label>
                <input type="number" class="form-control" name="amount" id="amount" min="0" step="0.01"
                  value="{{$transaction->amount}}" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="transaction_type" class="form-label">Tipo de transacción</label>
                <select class="form-select" name="transaction_type" id="transaction_type" required>
                  <option disabled>--Seleccione un tipo de transacción--</option>
                  <option value="income" {{ $transaction->transaction_type == 'income' ? 'selected' : '' }}>Ingreso</option>
                  <option value="expense" {{ $transaction->transaction_type == 'expense' ? 'selected' : '' }}>Gasto</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select class="form-select" name="category_id" id="category_id" required>
                  <option disabled>--Seleccione una categoría--</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                      {{$category->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label for="transaction_date" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="transaction_date" id="transaction_date"
                  value="{{$transaction->transaction_date}}" required>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="bi bi-plus-lg me-2"></i>
                  Editar Transacción
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('editTransactionForm').addEventListener('submit', function(event) {
  const errorContainer = document.getElementById('client-validation-errors');
  errorContainer.innerHTML = '';

  const description = document.getElementById('description').value.trim();
  const amount = parseFloat(document.getElementById('amount').value);
  const type = document.getElementById('transaction_type').value;
  const category = document.getElementById('category_id').value;
  const date = document.getElementById('transaction_date').value;

  let errors = [];

  if (!description) {
    errors.push('La descripción es obligatoria.');
  }

  if (isNaN(amount) || amount <= 0) {
    errors.push('El monto debe ser mayor a 0.');
  }

  if (!type || type === '--Seleccione un tipo de transacción--') {
    errors.push('Debe seleccionar el tipo de transacción.');
  }

  if (!category || category === '--Seleccione una categoría--') {
    errors.push('Debe seleccionar una categoría.');
  }

  if (!date) {
    errors.push('La fecha es obligatoria.');
  }

  if (errors.length > 0) {
    event.preventDefault();

    const alertDiv = document.createElement('div');
    alertDiv.classList.add('alert', 'alert-danger');

    const ul = document.createElement('ul');
    errors.forEach(error => {
      const li = document.createElement('li');
      li.textContent = error;
      ul.appendChild(li);
    });

    alertDiv.appendChild(ul);
    errorContainer.appendChild(alertDiv);
  }
});
</script>
@endsection
