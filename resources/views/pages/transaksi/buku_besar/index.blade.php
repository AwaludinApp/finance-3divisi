<?php
/*
The MIT License (MIT)

Copyright (c) 2023- 

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/
?>

@extends('layouts.app2')

@php
    $no = 0;
@endphp

@section('links')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Transaksi</a></li>
    <li class="breadcrumb-item active">Service</li>
</ol>
@endsection

@section('component')
<button type="button" data-parent-akun="-1" data-level="1" data-action="add" class="btn btn-primary" data-toggle="modal" data-target="#addTransaksi">
  Tambah
</button>

@endsection

@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                <table class="table table-bordered datatable-ajax">
                    <thead>
                        <tr>
                            <th width="2%">No</th>
                            <th width="14%">Tanggal</th>
                            <th width="12%">Kode Akun</th>
                            <th>Akun</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Keterangan</th>
                            <th width="80">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php /*
                        @foreach ($buku_besar as $buku)
                            <tr class="tr-{{ $buku->id }}">
                                <td>{{ ++$no }}</td>
                                <td>{{ $buku->tanggal_transaksi->isoFormat('D MMMM Y') }}</td>
                                <td class="text-center">{{ $buku->akun->kode_akun }}</td>
                                <td>{{ $buku->akun->nama_akun }}</td>
                                <td class="text-right">{{ $buku->pemasukan ? 'Rp. ' . number_format($buku->pemasukan, 0, ',', '.') : '' }}</td>
                                <td class="text-right">{{ $buku->pengeluaran ? 'Rp. ' . number_format($buku->pengeluaran, 0, ',', '.') : ''  }}</td>
                                <td>{{ $buku->keterangan }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" data-action="edit" 
                                        data-toggle="modal" data-target="#editTransaksi"
                                        data-id="{{ $buku->id }}"
                                        data-nama="{{ $buku->akun->nama_akun }}"
                                        data-kode="{{ $buku->akun->kode_akun }}">
                                        <i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" 
                                        data-toggle="modal" data-target="#deleteDialog"
                                        data-id="{{ $buku->id }}"
                                        data-info="{{ $buku->akun->kode_akun }}" 
                                        data-url="{{ route('buku_besar.destroy', ['buku_besar' => $buku->id]) }}">
                                        <i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        */ ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addTransaksi" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                        <h5>Tambah Data Transaksi</h5>
                    </div>
                    <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <form id="form-transaksi" name="form-transaksi" class="form-horizontal">
                   <div class="form-group">
                        <label class="col-sm-12 control-label">Tanggal Transaksi</label>
                        <div class="col-sm-12">
                            <input type="text" name="tanggal_transaksi" class="form-control tanggal_transaksi">
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="col-sm-12 control-label">Akun</label>
                        <div class="col-sm-12">
                            <select name="akun_id" class="form-control select2">
                                <option value="">Pilih Akun</option>
                            @foreach ($akuns as $akun)
                                <?php
                                $parents = null;
                                switch($akun->level) {
                                    case 1:
                                        if ($akun->kategori != null)
                                            $parents = $akun->kategori->nama_kategori;
                                        break;
                                    case 2:
                                        if ($akun->parent->kategori != null)
                                            $parents = $akun->parent->kategori->nama_kategori . ' > ' .$akun->parent->nama_akun; 
                                        break;
                                    case 3:
                                        if ($akun->parent->parent->kategori != null)
                                            $parents = $akun->parent->parent->kategori->nama_kategori . ' > ' .$akun->parent->parent->nama_akun . ' > ' . $akun->parent->nama_akun;
                                        break;   
                                    case 3:
                                        if ($akun->parent->parent->parent->kategori != null)
                                            $parents = $akun->parent->parent->parent->kategori->nama_kategori . ' > ' . $akun->parent->parent->parent->nama_akun . ' > ' . $akun->parent->parent->nama_akun . ' > ' . $akun->parent->nama_akun;
                                        break;      
                                }
                                ?>
                                @if($parents != null)
                                    <option kode="{{ $akun->kode_akun }}" data-akun="{{ $akun->nama_akun }}"
                                        value="{{ $akun->id }}"
                                        data-parents="{{ $parents }}">{{ $akun->kode_akun }} :: {{ $akun->nama_akun }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Pemasukan / Pengeluaran</label>
                        <div class="col-sm-12">
                            <select name="tipe" class="form-control">
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nilai</label>
                        <div class="col-sm-12">
                            <input data-type="currency" name="nilai" class="form-control nilai">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Keterangan</label>
                        <div class="col-sm-12">
                            <textarea name="keterangan" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <!-- <button type="button" class="btn btn-primary" data-action="add" id="savedata" value="create">Simpan akun</button> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-center"> 
                      <button type="button" class="btn btn-primary" data-action="add" id="simpandata" value="create">Simpan Transaksi</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTransaksi" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div> -->
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                        <h5>Tambah Data Transaksi</h5>
                    </div>
                    <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <form id="form-transaksi-ubah" name="form-transaksi" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                   @method('PUT')
                   <div class="form-group">
                        <label class="col-sm-12 control-label">Tanggal Transaksi</label>
                        <div class="col-sm-12">
                            <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control tanggal_transaksi">
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="col-sm-12 control-label">Akun</label>
                        <div class="col-sm-12">
                            <select name="akun_id" id="select-akun" class="form-control select2-edit-trans">
                                <option value="">Pilih Akun</option>
                            @foreach ($akuns as $akun)
                                <?php
                                $parents = null;
                                switch($akun->level) {
                                    case 1:
                                        if ($akun->kategori != null)
                                            $parents = $akun->kategori->nama_kategori;
                                        break;
                                    case 2:
                                        if ($akun->parent->kategori != null)
                                            $parents = $akun->parent->kategori->nama_kategori . ' > ' .$akun->parent->nama_akun; 
                                        break;
                                    case 3:
                                        if ($akun->parent->parent->kategori != null)
                                            $parents = $akun->parent->parent->kategori->nama_kategori . ' > ' .$akun->parent->parent->nama_akun . ' > ' . $akun->parent->nama_akun;
                                        break;   
                                    case 3:
                                        if ($akun->parent->parent->parent->kategori != null)
                                            $parents = $akun->parent->parent->parent->kategori->nama_kategori . ' > ' . $akun->parent->parent->parent->nama_akun . ' > ' . $akun->parent->parent->nama_akun . ' > ' . $akun->parent->nama_akun;
                                        break;      
                                }
                                ?>
                                @if($parents != null)
                                    <option kode="{{ $akun->kode_akun }}" data-akun="{{ $akun->nama_akun }}"
                                        value="{{ $akun->id }}"
                                        data-parents="{{ $parents }}">{{ $akun->kode_akun }} :: {{ $akun->nama_akun }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Pemasukan / Pengeluaran</label>
                        <div class="col-sm-12">
                            <select id="tipe" name="tipe" class="form-control">
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nilai</label>
                        <div class="col-sm-12">
                            <input data-type="currency" name="nilai" id="nilai" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Keterangan</label>
                        <div class="col-sm-12">
                            <textarea name="keterangan" id="keterangan" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <!-- <button type="button" class="btn btn-primary" data-action="add" id="savedata" value="create">Simpan akun</button> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-center"> 
                      <button type="button" class="btn btn-primary" data-action="add" id="ubahdata" value="create">Simpan Transaksi</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteDialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                        <h5>Hapus Data</h5>
                    </div>
                    <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <p>Anda ingin menghapus data ini?</p>                   
            </div>
            <div class="modal-footer modal-footer-hapus">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" data-id="-1" data-action="add" id="hapusData" value="create">Hapus</button>
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="current-edited-id" value="-1">
@endsection

@push('scripts')
<script>
    $('#simpandata').on('click', function(event){
        button = $(this)
        event.preventDefault();

        var currentEditedId = $('#current-edited-id').val()
        var action = button.data('action')
        console.log(action)
        var url = action == "add" ? "{{ route('buku_besar.store') }}" : "{{ url('buku_besar') }}/" + currentEditedId

        $.ajax({
            url: url,
            method:'POST',
            data: $('#form-transaksi').serialize(),
            success: function(response) {
                toastr.success(response.message)

                setTimeout(function(){
                    window.location = response.redirect
                }, 2000)
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(k, v){
                    toastr.error(v[0])
                })
                toastr.error("Transaksi gagal disimpan")
            }


        })
    })

    $('#ubahdata').on('click', function(event){
        button = $(this)
        event.preventDefault();

        var currentEditedId = $('#current-edited-id').val()
        var action = button.data('action')
        console.log(action)
        var url = "{{ url('buku_besar') }}/" + currentEditedId

        $.ajax({
            url: url,
            method:'PUT',
            data: $('#form-transaksi-ubah').serialize(),
            success: function(response) {
                toastr.success(response.message)

                if (response.success) {
                    setTimeout(function(){
                        window.location = response.redirect
                    }, 2000)
                } else {
                    $('#addTransaksi').modal('hide')
                }
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(k, v){
                    toastr.error(v[0])
                })
                toastr.error("Transaksi gagal diubah")
            }

        })
    })

    $('#addTransaksi').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
        emptyField()
    })

    $('#deleteDialog').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
        $('#currrent-edited-id').val(button.data('id'))
        $('#hapusData').data('id', button.data('id'))
    })

    $('#hapusData').on('click', function(){
        btn = $(this)
        $.ajax({
            url: "{{ url('buku_besar') }}/" + btn.data('id'),
            method: 'DELETE',
            success: function(response) {
                toastr.success(response.message)
                if (response.success) {
                    $('.tr-' + btn.data('id')).hide().remove()
                    $('#deleteDialog').modal('hide')
                }
            }
        })
    })

    $('#editTransaksi').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
        console.log('edit Akun -- ' + button.data('id') + '- ' + button.data('kode') + ' - ' + button.data('nama'))
        

        $('#current-edited-id').val(button.data('id'))
        $.ajax({
            url: "{{ url('buku_besar') }}/" + button.data('id'),
            success: function (response) {
                $('#tanggal_transaksi').val(response.tanggal_transaksi)
                $('#select-akun').val(response.result.akun_id).trigger('change')
                $('#tipe').val(response.result.tipe)
                $('#nilai').val(response.nilai)
                $('#keterangan').val(response.result.keterangan)
            }
        })

        // $('#idAkun').val(button.data('id'))
    })

    moment.locale('id');
    
    $('.tanggal_transaksi').daterangepicker({
        singleDatePicker: true,
    })

    function formatAkun(akun) {
        if (!akun.id) {
            akun.text
        }

        console.log(akun)

        el = $(akun.element)
        var kode_akun = el.attr('kode')

        var $akun= $('<span>' + 
            '<strong>' + kode_akun + '</strong><br>' +
            '<span class="badge badge-success">' + el.data('parents') + '</span><br>' + 
            '<span>' + el.data('akun') + '</span>'
        + '</span>');

        return $akun;
    }

    $('.select2').select2({
      theme: 'bootstrap4',
      dropdownParent: $('#addTransaksi'),
      templateResult: formatAkun,
      placeholder: "Pilih Akun"
    })

    $('.select2-edit-trans').select2({
      theme: 'bootstrap4',
      dropdownParent: $('#editTransaksi'),
      templateResult: formatAkun,
      placeholder: "Pilih Akun"
    })

    $('.data-table').DataTable()

    function emptyField() {
        $('.nilai').val('')
    }
</script>

<script>
$(function(){
  var table = $('.datatable-ajax').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('buku_besar.data') }}",
    columns: [
      {data:"id", name: "id"},
      {data:"tanggal_transaksi", name:"tanggal_transaksi"},
      {data:"kode_akun", name:"kode_akun"},
      {data:"nama_akun", name:"nama_akun"},
      {data:"pemasukan", name:"pemasukan"},
      {data:"pengeluaran", name:"pengeluaran"},
      {data:"keterangan", name:"keterangan"},
      {data:"action", name:"action", orderable:false, searchable:false},
    ],
    columnDefs: [
        {
            targets: 2,
            className: "dt-body-center"
        },
        {
            targets: 4,
            className: "dt-body-right"
        },
        {
            targets: 5,
            className: "dt-body-right"
        }
    ],
  })
})
</script>

@endpush