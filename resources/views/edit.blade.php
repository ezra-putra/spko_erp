@extends('layout.main')
@section('content')
<h3>Edit Transaction</h3>
<form action="{{ route('edit.transaction', $spko->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="col-md-12 mb-4">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="select-employee">Employee</label>
                <select class="form-select" id="select-employee" name="employee">
                    <option value="">--Choose Employee--</option>
                    @foreach ($employee as $e)
                    <option value="{{ $e->id }}">{{ $e->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="select-spko">SPKO</label>
                <select class="form-select spko-select" id="select-spko" name="spko">
                    <option value="">--Choose SPKO--</option>
                    <option value="Cor" {{ $spko->process == 'Cor' ? 'selected' : '' }}>Cor</option>
                    <option value="Brush" {{ $spko->process == 'Brush' ? 'selected' : '' }}>Brush</option>
                    <option value="Bombing" {{ $spko->process == 'Bombing' ? 'selected' : '' }}>Bombing</option>
                    <option value="Slep" {{ $spko->process == 'Slep' ? 'selected' : '' }}>Slep</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="dateInput">Transaction Date</label>
            <div class="col-md-12 mb-2">
                <input type="text" id="dateInput" name="trans_date"
                    class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" value="{{ $spko->trans_date }}" />
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
            @foreach ($spkoitem as $s)
                <tr>
                    <td>
                        <select class="form-select" id="select-product" name="product[]" disabled>
                            <option value="">--Choose product--</option>
                            <option value="{{ $s->product->id }}" {{ $s->id_product == $s->product->id ? 'selected' : '' }}>
                                {{ $s->product->serial_no }} - {{ $s->product->description }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="number" name="qty[]" id="qtynumber" value="{{ $s->qty }}" min="0">
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row justify-content-end">
        <div class="col-auto">
            <input type="submit" class="btn btn-success" value="Update Transactions">
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">

    var today = new Date();
    var minDate = new Date(today);
    minDate.setDate(today.getDate())
    flatpickr("#dateInput", {
        minDate: minDate,
        dateFormat: "Y-m-d"
    });
</script>
@endsection
