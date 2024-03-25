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

@section('component')
<button type="button" data-parent-kategori="-1" data-level="1" data-action="add" class="btn btn-primary" data-toggle="modal" data-target="#addKategori">
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
                <table id="data-table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kategori</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $kategori)
                            <tr class="tr-{{ $kategori->id }}">
                                <td>{{ ++$no }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-action="edit" 
                                        data-nama-kategori="{{ $kategori->nama_kategori }}" 
                                        data-kategori-id="{{ $kategori->id }}"
                                        data-toggle="modal" data-target="#editKategori">
                                        <i class="fa fa-edit"></i></button>
                                    <a title="child" class="btn btn-sm btn-success" href="{{ route('kategori.akun', ['kategori' => $kategori->id]) }}">
                                        <i class="fa fa-list"></i>
                                    </a>    
                                    <button 
                                        data-toggle="modal" data-target="#deleteDialog"
                                        data-id="{{ $kategori->id }}"
                                        class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2 float-sm-right">
                    {{ $kategoris->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addKategori" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
            <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                        <h5>Tambah Kategori</h5>
                    </div>
                    <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <form id="form-kategori" name="form-kategori" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
     
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nama Kategori</label>
                        <div class="col-sm-12">
                            <input id="description" name="nama_kategori" required placeholder="Enter Description" class="form-control">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <input type="hidden" name="parent_kategori" value="" id="parent_kategori">   
                     <!-- <button type="button" class="btn btn-primary" data-action="add" id="savedata" value="create">Simpan Kategori</button> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-center"> 
                      <button type="button" class="btn btn-primary" data-action="add" id="savedata" value="create">Simpan Kategori</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editKategori" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
            <h5 class="modal-title">Ubah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                        <h5>Ubah Kategori</h5>
                    </div>
                    <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <form id="form-kategori-ubah" name="form-kategori" class="form-horizontal">
                   <input type="hidden" name="id" id="idKategori">
                    @method('PUT')
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nama Kategori</label>
                        <div class="col-sm-12">
                            <input id="nama_kategori" name="nama_kategori" required placeholder="Enter Description" class="form-control">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <input type="hidden" name="parent_kategori" value="" id="parent_kategori">   
                     <!-- <button type="button" class="btn btn-primary" data-action="ubah" id="ubahdata" value="create">Simpan Kategori</button> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-center"> 
                      <button type="button" class="btn btn-primary" data-action="ubah" id="ubahdata" value="create">Simpan Kategori</button>
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
                <p class="additional-message"></p>                   
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
    $('#savedata').on('click', function(event){
        button = $(this)
        event.preventDefault();

        var currentEditedId = $('#current-edited-id').val()
        var action = button.data('action')
        console.log(action)
        var url = action == "add" ? "{{ route('kategori.store') }}" : "{{ url('kategori') }}/" + currentEditedId

        $.ajax({
            url: url,
            method:'POST',
            data: $('#form-kategori').serialize(),
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
        var url = "{{ url('kategori') }}/" + currentEditedId

        $.ajax({
            url: url,
            method:'PUT',
            data: $('#form-kategori-ubah').serialize(),
            success: function(response) {
                toastr.success(response.message)
                setTimeout(function(){
                    window.location = response.redirect
                }, 2000)
            },
            error: function(response) {

            }

        })
    })

    $('#addKatagori').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
    })

    $('#editKategori').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
        $('#nama_kategori').val(button.data('nama-kategori'))
        $('#idKategori').val(button.data('kategori-id'))
        $('#current-edited-id').val(button.data('kategori-id'))
    })

    $('#deleteDialog').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
        $('#currrent-edited-id').val(button.data('id'))
        $('#hapusData').data('id', button.data('id'))
        // check existance 
        // $.ajax({
        //     url: "{{ url('akun_existance') }}/" + button.data('id'),
        //     success: function(response) {
        //         if (response.exists) {
        //             $('.additional-message').html(response.message)
        //         } else {
        //             $('.additional-message').html('')
        //         }
        //     }
        // })
    })

    $('#hapusData').on('click', function(){
        btn = $(this)
        $.ajax({
            url: "{{ url('kategori') }}/" + btn.data('id'),
            method: 'DELETE',
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message)
                    $('.tr-' + btn.data('id')).hide().remove()
                    $('#deleteDialog').modal('hide')
                } else {
                    toastr.error(response.message)
                }
            }
        })
    })

</script>
@endpush