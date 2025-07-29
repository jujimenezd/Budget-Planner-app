@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">Hola {{ $user->name }}</h1>
  <p>Email: {{ $user->email }}</p>

  <div id="client-validation-errors" class="alert alert-danger d-none"></div>

  <form id="userProfileForm" action="{{ route('my-profile.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name" class="form-label">Modificar nombre</label>
      <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label font-italic">Cambiar email</label>
      <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
  </form>

  <div class="mt-5">
    <h4 class="mb-3">Distribución de tus gastos por categoría </h4>
    <div style="max-width: 300px; margin: auto;">
      <canvas id="graficoGastosPorCategoria"></canvas>
    </div>
</div>

<script>
document.getElementById('userProfileForm').addEventListener('submit', function(event) {
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const errorDiv = document.getElementById('client-validation-errors');
  errorDiv.classList.add('d-none');
  errorDiv.innerHTML = '';

  const errors = [];

  if (name.length < 3) {
    errors.push('El nombre debe tener al menos 3 caracteres.');
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    errors.push('Ingrese un correo electrónico válido.');
  }

  if (errors.length > 0) {
    event.preventDefault();
    const ul = document.createElement('ul');
    errors.forEach(error => {
      const li = document.createElement('li');
      li.textContent = error;
      ul.appendChild(li);
    });
    errorDiv.appendChild(ul);
    errorDiv.classList.remove('d-none');
  }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = {!! json_encode($labels) !!};
  const data = {!! json_encode($data) !!};

  const ctx = document.getElementById('graficoGastosPorCategoria').getContext('2d');
  new Chart(ctx, {
      type: 'pie',
      data: {
          labels: labels,
          datasets: [{
              label: 'Gasto por categoría',
              data: data,
              backgroundColor: [
                    '#0d6efd', 
                    '#74b9ff', 
                    '#00b894', 
                    '#dfe6e9', 
                    '#2d3436', 
                    '#a29bfe', 
                    '#ffeaa7', 
                    '#fab1a0', 
],
              borderWidth: 1
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: {
                  position: 'bottom'
              },
              tooltip: {
                  callbacks: {
                      label: function(context) {
                          return context.label + ': $' + context.raw.toLocaleString();
                      }
                  }
              }
          }
      }
  });
</script>
@endsection
