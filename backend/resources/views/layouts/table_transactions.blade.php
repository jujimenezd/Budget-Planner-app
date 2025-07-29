<div class="card shadow">
  <div class="card-header bg-success text-white">
    <h5 class="card-title mb-0">
      <i class="bi bi-list-ul me-2"></i>
      Total de transacciones: {{count($transactions)}}
    </h5>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-striped table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Tipo</th>
            <th>Categoría</th>
            <th>Fecha</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transactions as $transaction)
          <tr>
            <td class="fw-semibold">{{$transaction->description}}</td>
            <td class="text-success">{{number_format($transaction->amount, 2, ',', '.')}}</td>
            <td>{{$transaction->transaction_type}}</td>
            <td><span class="badge bg-secondary">{{$transaction->category->name}}</span></td>
            <td>{{$transaction->transaction_date}}</td>
            <td class="d-flex gap-4">
              <a href="{{route('transactions.edit', $transaction->id)}}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i>
              </a>
              <form action="{{route('transactions.destroy', $transaction->id)}}" method="POST">
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
  </div>
</div>