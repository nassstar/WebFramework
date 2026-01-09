@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Stok</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Penginput (User)</th>
                    <th>Tanggal Stok</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Modal untuk Ajax --}}
<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {{-- Konten modal akan di-load via Ajax --}}
        </div>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#my-modal').load(url, function() {
            $('#my-modal').modal('show');
        });
    }
    
    $(document).ready(function() {
        var dataStok = $('#table_stok').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                "url": "{{ url('stok/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                {data: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false},
                {data: 'barang_nama', name: 'm_barang.barang_nama'},
                {data: 'penginput', name: 'm_user.nama'},
                {data: 'stok_tanggal', name: 'stok_tanggal'},
                {data: 'stok_jumlah', name: 'stok_jumlah'},
                {data: 'aksi', className: "text-center", orderable: false, searchable: false}
            ]
        });
    });
</script>
@endpush
