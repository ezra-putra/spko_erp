@extends('layout.main')

@section('content')
{{-- <h3>Table of Products</h3>
<table class="table table-bordered table-hover mb-2">
    <thead class="table-info">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Serial Number</th>
            <th scope="col">Description</th>
            <th scope="col">Carat</th>
        </tr>
    </thead>
    <tbody>
        @php
            $counter = 1;
        @endphp
        @foreach ($product as $p)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $p->serial_no }}</td>
                <td>{{ $p->description }}</td>
                <td>{{ $p->carat }}</td>
            </tr>
        @endforeach
    </tbody>
</table> --}}

<h3 class="mt-4">New Transaction</h3>
<form action="{{ route('new.transaction') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="select-employee">Employee</label>
                    <select class="form-select" id="select-employee" name="employee">
                        <option value="">--Choose Employee--</option>
                        @foreach ($employee as $e)
                        <option value="{{ $e->id }}">{{ $e->nama }} - {{ $e->rank }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="select-spko">SPKO</label>
                    <select class="form-select spko-select" id="select-spko" name="spko">
                        <option value="">--Choose SPKO--</option>
                        <option value="Cor">Cor</option>
                        <option value="Brush">Brush</option>
                        <option value="Bombing">Bombing</option>
                        <option value="Slep">Slep</option>
                    </select>
                </div>
            </div>


        </div>
    <table class="table table-bordered" id="transactionTable">
        <thead class="table-info">
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select class="form-select" id="select-product" name="product[]">
                        <option value="">--Choose product--</option>
                        @foreach ($product as $p)
                        <option value="{{ $p->id }}">{{ $p->serial_no }} - {{ $p->description }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input class="form-control" type="number" name="qty[]" id="qtynumber" min="0">
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5" class="text-center">
                    <button id="addproduct" class="btn btn-primary">Add More Product</button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row justify-content-end">
        <div class="col-auto">
            <input type="submit" class="btn btn-success" value="Create Transactions">
        </div>
    </div>
</form>

<h3>Transaction List</h3>
<table class="table table-bordered table-hover mb-2">
    <thead class="table-info">
        <tr>
            <th scope="col">#</th>
            <th scope="col">SPKO Number</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $counter = 1;
        @endphp
        @foreach ($spko as $s)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $s->sw }}</td>
                <td>
                    <a href="{{ url('edit', $s->id) }}" class="btn btn-icon">
                        <i class="fa fa-pencil me-50"></i>
                    </a>
                    <a href="{{ url('/invoice', $s->id) }}" class="btn btn-icon">
                        <i class="fa fa-print me-50"></i>
                    </a>
                    <form method="POST" action="{{ route('destroy', $s->id) }}"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-icon btn-icon-danger"
                            onclick="return confirm('Do you want to delete this Transaction (ID: {{ $s->sw }})?');">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    document.getElementById('addproduct').addEventListener('click', function(e) {
        e.preventDefault();
        var table = document.getElementById('transactionTable').getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length - 1);

        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);

        cell1.innerHTML = `
            <select class="form-select" name="product[]">
                <option value="">--Choose product--</option>
                @foreach ($product as $p)
                <option value="{{ $p->id }}">{{ $p->serial_no }} - {{ $p->description }}</option>
                @endforeach
            </select>
        `;
        cell2.innerHTML = `<input type="number" name="qty[]" class="form-control qty" min="0">`;
        cell3.innerHTML = `<button type="button" class="btn btn-icon-danger remove-row">
                            <i class="fa fa-trash"></i>
                            </button>`;

        newRow.querySelector('.remove-row').addEventListener('click', function() {
            this.closest('tr').remove();
        });

        var spkoValue = document.querySelector('.spko-select').value;
        newRow.querySelector('.spko-select').value = spkoValue;
    });

    document.querySelectorAll('.remove-row').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('tr').remove();
        });
    });

    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('qty')) {
            if (e.target.value < 0) {
                e.target.value = 0;
            }
        }
    });

    document.querySelector('.spko-select').addEventListener('change', function() {
        var spkoValue = this.value;
        document.querySelectorAll('.spko-select').forEach((select, index) => {
            if (index !== 0) {
                select.value = spkoValue.value;
            }
        });
    });
</script>

@endsection



