@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
          <h4 class="card-title mb-0"></h4>
          <i class="bi bi-plus-circle me-2">Agregar ingresos y gastos</i>
        </div>
        <div class="card-body">

          <form id="transactionForm" action="{{route('transactions.store')}}" method="POST">
            @csrf
            <div id="client-validation-errors"></div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="description" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="description" id="description" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="amount" class="form-label">Monto</label>
                <input type="number" class="form-control" name="amount" id="amount" min="0" step="0.01" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="transaction_type" class="form-label">Tipo de transacción</label>
                <select class="form-select" name="transaction_type" id="transaction_type" required>
                  <option selected disabled>--Seleccione un tipo de transacción--</option>
                  <option value="income">Ingreso</option>
                  <option value="expense">Gasto</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select class="form-select" name="category_id" id="category_id" required>
                  <option selected disabled>--Seleccione una categoría--</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label for="transaction_date" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="transaction_date" id="transaction_date" required>
              </div>

              <div class="col-md-6 mb-3">
                <a href="{{ route('report.transactions.pdf') }}" class="btn btn-primary mt-4">
                    Descargar reporte de transacciones (PDF)
                </a>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-md">
                  <i class="bi bi-plus-lg me-2"></i>
                  Agregar transacción
                </button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-md-12">
      @include('layouts.table_transactions')
    </div>
  </div>
</div>

<script>
document.getElementById('transactionForm').addEventListener('submit', function(event) {
  
  const existingErrors = document.getElementById('client-validation-errors');
  existingErrors.innerHTML = '';

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
    errors.push('El monto debe ser un número mayor a 0.');
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

