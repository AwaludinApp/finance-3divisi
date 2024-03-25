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
    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('kategori.akun', ['kategori' => $kategori_id ]) }}">{{ $nama_kategori }}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('subakun.akun', ['akun' => $sub_akun_id ]) }}">{{ $nama_sub_akun }}</a></li>
    <li class="breadcrumb-item active">{{ $nama_akun }}</li>
</ol>
@endsection

@section('component')
<button type="button" data-parent-akun="-1" data-level="1" data-action="add" class="btn btn-primary" data-toggle="modal" data-target="#addAkun">
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
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Akun</th>
                            <th>Akun</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($akuns as $akun)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $akun->kode_akun }}</td>
                                <td>{{ $akun->nama_akun }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" data-action="edit" 
                                        data-toggle="modal" data-target="#editAkun"
                                        data-id="{{ $akun->id }}"
                                        data-nama="{{ $akun->nama_akun }}"
                                        data-kode="{{ $akun->kode_akun }}">
                                        <i class="fa fa-edit"></i></button>
                                    <a class="btn btn-sm btn-success" href="{{ route('akunchild.subakun.akun', ['akun' => $akun->id ]) }}">
                                    <i class="fa fa-list"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2 float-sm-right">
                    {{ $akuns->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAkun" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="form-akun" name="form-akun" class="form-horizontal">
                   <input type="hidden" name="id" id="id">

                   <div class="form-group">
                        <label class="col-sm-12 control-label">Kode akun</label>
                        <div class="col-sm-12">
                            <input name="kode_akun" required placeholder="Enter Description" class="form-control">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nama akun</label>
                        <div class="col-sm-12">
                            <input name="nama_akun" required placeholder="Enter Description" class="form-control">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" value="{{ $parent_id }}" name="parent_id">   
                     <button type="button" class="btn btn-primary" data-action="add" id="savedata" value="create">Simpan akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAkun" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-akun-ubah" name="form-akun" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                   @method('PUT')
                   <div class="form-group">
                        <label class="col-sm-12 control-label">Kode akun</label>
                        <div class="col-sm-12">
                            <input id="kode_akun" name="kode_akun" required placeholder="Kode Akun" class="form-control">
                        </div>
                    </div>     
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nama Akun</label>
                        <div class="col-sm-12">
                            <input id="nama_akun" name="nama_akun" required placeholder="Nama Akun" class="form-control">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <input type="hidden" name="id" id="idAkun" value="">
                     <button type="button" class="btn btn-primary" data-action="ubah" id="ubahdata" value="create">Simpan akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="current-edited-id" value="-1">
@endsection

@push('scripts')
<script>
    $('#savedata').on('click', function(event){
        button = $(this)
        event.preventDefault();

        var currentEditedId = $('#current-edited-id').val()
        var action = button.data('action')
        console.log(action)
        var url = action == "add" ? "{{ route('akun.store') }}" : "{{ url('akun') }}/" + currentEditedId

        $.ajax({
            url: url,
            method:'POST',
            data: $('#form-akun').serialize(),
            success: function(response) {
                toastr.success(response.message)
                setTimeout(function(){
                    window.location = response.redirect
                }, 2000)
            }

        })
    })

    $('#ubahdata').on('click', function(event){
        button = $(this)
        event.preventDefault();

        var currentEditedId = $('#current-edited-id').val()
        var action = button.data('action')
        console.log(action)
        var url = "{{ url('akun') }}/" + currentEditedId

        $.ajax({
            url: url,
            method:'PUT',
            data: $('#form-akun-ubah').serialize(),
            success: function(response) {
                toastr.success(response.message)
                setTimeout(function(){
                    window.location = response.redirect
                }, 2000)
            }

        })
    })

    $('#addAkun').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
    })

    $('#editAkun').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
        console.log('edit Akun -- ' + button.data('id') + '- ' + button.data('kode') + ' - ' + button.data('nama'))
        
        $('#current-edited-id').val(button.data('id'))
        $('#kode_akun').val(button.data('kode'))
        $('#nama_akun').val(button.data('nama'))
        $('#idAkun').val(button.data('id'))
    })

</script>
@endpush