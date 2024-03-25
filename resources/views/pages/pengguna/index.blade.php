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
<button type="button" data-parent-pengguna="-1" data-level="1" data-action="add" class="btn btn-primary" data-toggle="modal" data-target="#addpengguna">
  Tambah
</button>

@endsection

@php
    function role($role) {
        switch($role) {
            case 1: return 'Admin';break;
            case 2: return 'Service';break;
            case 3: return 'Sparepart';break;
            case 5: return 'Second';break;
            case 4: return 'Direksi';break;
        }
    }
@endphp

@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                <table class="table table-bordered data-table" id="data-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="140px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="tr-{{ $user->id }}">
                                <td>{{ ++$no }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ role($user->role) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-action="edit"
                                        data-id="{{ $user->id }}" 
                                        data-name="{{ $user->name }}" 
                                        data-email="{{ $user->email }}" 
                                        data-role="{{ $user->role }}" 
                                        data-toggle="modal" data-target="#edituser">
                                        <i class="fa fa-edit"></i></button>
                                    @if ($user->role != 1)
                                    <button class="btn btn-sm btn-danger" data-id="{{ $user->id }}" data-url="{{ route('pengguna.destroy', ['pengguna' => $user->id ]) }}"
                                        data-toggle="modal" data-target="#deleteDialog"><i class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2 float-sm-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addpengguna" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
            <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                        <h5>Tambah Penguna</h5>
                    </div>
                    <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <!-- <hr> -->
                 <form id="form-pengguna" name="form-pengguna" class="form-horizontal">     
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nama</label>
                        <div class="col-sm-12">
                            <input name="name" required placeholder="Masukkan Nama" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" name="email" required placeholder="Masukakn Email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Password</label>
                        <div class="col-sm-12">
                            <input type="password" name="password" required placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Konfirmasi Password</label>
                        <div class="col-sm-12">
                            <input type="password" name="password_confirmation" required placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Role</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="role">
                                <option value="">Pilih Role</option>
                                <option value="2">Service</option>
                                <option value="3">Sparepart</option>
                                <option value="5">Second</option>
                                <option value="4">Direksi</option>
                                <!-- <option value="1">Admin</option> -->
                            </select>
                        </div>
                    </div>
      
                    <!-- <div class="col-sm-offset-2 col-sm-10 text-center"> -->
                    <!-- <div class="col-12 text-center"> 
                      <input type="hidden" name="parent_pengguna" value="" id="parent_pengguna">   
                      <button type="button" class="btn btn-primary" data-action="add" id="savedata" value="create">Simpan pengguna</button>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-center"> 
                      <input type="hidden" name="parent_pengguna" value="" id="parent_pengguna">   
                      <button type="button" class="btn btn-primary" data-action="add" id="savedata" value="create">Simpan pengguna</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edituser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">
                    Ubah pengguna
                </h4>
            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                        <h5>Ubah Penguna</h5>
                    </div>
                    <div class="col-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <form id="form-pengguna-ubah" name="form-user-ubah" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                    @method('PUT')
                   <div class="form-group">
                        <label class="col-sm-12 control-label">Nama</label>
                        <div class="col-sm-12">
                            <input id="name" name="name" required placeholder="Masukkan Nama" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" id="email" name="email" required placeholder="Masukakn Email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Password</label>
                        <div class="col-sm-12">
                            <input type="password" id="password" name="password" required placeholder="" class="form-control" value="">
                        </div>
                        <div class="col-sm-12"><small>Kosongkan password apabila tidak ingin di ubah</small></div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Konfirmasi Password</label>
                        <div class="col-sm-12">
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Role</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="role" name="role">
                                <option value="">Pilih Role</option>
                                <option value="2">Service</option>
                                <option value="3">Sparepart</option>
                                <option value="5">Second</option>
                                <option value="4">Direksi</option>
                                <!-- <option value="1">Admin</option> -->
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-12 text-center"> 
                      <button type="button" class="btn btn-primary" data-action="add" id="ubahdata" value="create">Simpan pengguna</button>
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
        var url = action == "add" ? "{{ route('pengguna.store') }}" : "{{ url('pengguna') }}/" + currentEditedId

        $.ajax({
            url: url,
            method:'POST',
            data: $('#form-pengguna').serialize(),
            success: function(response) {
                toastr.success(response.message)

                if (response.success) {
                    setTimeout(function(){
                        window.location = response.redirect
                    }, 2000)
                }
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(k, v){
                    toastr.error(v[0])
                })
                toastr.error("Data Pengguna gagal disimpan")
            }

        })
    })

    $('#ubahdata').on('click', function(event){
        button = $(this)
        event.preventDefault();

        var currentEditedId = $('#current-edited-id').val()
        var action = button.data('action')
        console.log(action)
        var url = "{{ url('pengguna') }}/" + currentEditedId

        $.ajax({
            url: url,
            method:'POST',
            data: $('#form-pengguna-ubah').serialize(),
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
                toastr.error("Data pengguna gagal diubah")
            }

        })
    })

    $('#addpengguna').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)
    })

    $('#edituser').on('shown.bs.modal', function(event){
        var button = $(event.relatedTarget)

        $('#current-edited-id').val(button.data('id'))

        $('#name').val(button.data('name'))
        $('#email').val(button.data('email'))
        $('#role').val(button.data('role')).trigger('change')
        $('#id').val(button.data('id'))

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
            url: "{{ url('pengguna') }}/" + btn.data('id'),
            method: 'DELETE',
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message)
                    $('.tr-' + btn.data('id')).hide().remove()
                    $('#deleteDialog').modal('hide')
                } else {
                    toastr.error(response.message)
                }
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(k, v){
                    toastr.error(v[0])
                })
                toastr.error("Data Pengguna gagal dihapus")
            }
        })
    })


</script>
@endpush