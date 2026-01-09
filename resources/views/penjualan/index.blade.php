@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Kasir</th>
                    <th>Pembeli</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Wadah Modal --}}
{{-- Perhatikan: isinya kosong karena akan di-load oleh Ajax dari file show_ajax.blade.php --}}
<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

@endsection

@push('js')
<script>
    // 1. Fungsi untuk load modal via Ajax
    function modalAction(url = '') {
        $('#my-modal').load(url, function() {
            $('#my-modal').modal('show');
        });
    }

    // 2. DataTables Configuration
    $(document).ready(function() {
        var dataPenjualan = $('#table_penjualan').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                "url": "{{ url('penjualan/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                {data: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false},
                {data: 'penjualan_kode', name: 'penjualan_kode'},
                {data: 'kasir', name: 'm_user.nama'},
                {data: 'pembeli', name: 'pembeli'},
                {data: 'penjualan_tanggal', name: 'penjualan_tanggal'},
                {data: 'aksi', className: "text-center", orderable: false, searchable: false}
            ]
        });
    });
</script>
@endpush
