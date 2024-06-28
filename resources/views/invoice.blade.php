@extends('layout.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card mb-2" style="background-color: lightcyan">
                <div class="card-body">
                    {{-- @foreach ($spko as $s) --}}
                    @php
                        use Carbon\Carbon;
                    @endphp
                    <h6>Surat Perintah Kerja Operator</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p>ID Operator : {{ $spko->employee }}</p>
                            <p>Nama Operator : {{ $spko->employees->nama }}</p>
                            <p>Tanggal :  {{ Carbon::parse($spko->trans_date)->format('d F Y H:i:s') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>No. Spko : {{ $spko->sw }}</p>
                            <p>Proses : {{ $spko->process }}</p>
                            <p>Note : </p>
                        </div>
                    </div>
                    {{-- @endforeach --}}
                </div>
            </div>

            <table class="table table-bordered table-hover mb-2">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Carat</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($spkoitem as $s)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $s->product->description }}</td>
                            <td>{{ $s->product->carat }}</td>
                            <td>{{ $s->product->sub_category }}.{{ $s->product->serial_no }}</td>
                            <td>{{ $s->qty }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <a href="#" id="print-button" class="btn btn-success">Print</a>
        </div>
    </div>
</div>
<script>
    document.getElementById('print-button').addEventListener('click', function() {
        var printContents = document.querySelector('.col-md-9').innerHTML;
        var printContainer = document.createElement('div');
        printContainer.innerHTML = printContents;

        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    });
</script>
@endsection



