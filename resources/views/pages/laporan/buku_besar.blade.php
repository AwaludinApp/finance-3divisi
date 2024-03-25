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
@extends('layouts.laporan')

@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="">
                <!-- /.card-header -->
                <div class="report-body">
                <form id="form-laporan" method="GET" action="">

                    <div class="row">
                        <div class="col-sm-2">Mulai</div>
                        <div class="col-sm-2">Sampai</div>
                        <div class="col-sm-8">Akun</div>
                    </div>
                    <div class="form-group mt-2 d-print-none row">
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input type="text" value="{{ Carbon\Carbon::parse($start)->format('d/m/Y') }}" class="form-control" id="daterange-btn">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input type="text" value="{{ Carbon\Carbon::parse($end)->format('d-m-Y') }}  }}" class="form-control" id="daterange-btn-end">
                            </div>
                        </div>
                        <div class="col-3">
                        <select name="akun_id" id="akun_id" class="form-control select2">
                                    <option value="">Pilih Akun</option>
                                    <option kode="" data-akun="Semua Akun" value="Semua" data-parents="">Semua Akun</option>
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
                            <input type="hidden" name="dari_tanggal" id="dari-tanggal" value="{{ $start }}">
                            <input type="hidden" name="sampai_tanggal" id="sampai-tanggal" value="{{ $end  }}">
                        </div>
                        <div class="col-2"><button type="submit" class="btn btn-block btn-primary">Tampilkan</button></div>
                        <div class="col-1">

                        </div>
                        <!-- <div class="col-2">
                            <button class="btn btn-block btn-primary" onClick="lihatSemua()">Lihat Semua</button>
                        </div> -->
                        <!-- <div class="col-2 text-right">
                            <a class="btn btn-danger btn-block" href="{{ route('export.pdf', $queries) }}">Ekspor ke PDF</a>
                        </div> -->
                    </div>
                    <!-- /.form group -->

                    <div class="form-group mb-4 d-print-none row">
                        
                    </div>
                </form>
                <hr noshade="">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-sm-2 text-right">
                        <a class="btn btn-danger btn-block" href="{{ route('export.pdf', $queries) }}">Ekspor ke PDF</a>
                    </div>
                </div>
                <table width="100%">
                    <tr class="text-center">
                        <td colspan="2"><h3>LAPORAN KEUANGAN</h3></td>
                    </tr>

                    <tr class="text-center">
                        <td colspan="2"><h2>SERVICE</h2></td>
                    </tr>
                </table>
                
                <table width="100%" class="table table-bordered table-sm mb-4">    
                    <tr>
                        <td class="px-2" width="15%">DARI TANGGAL</td>
                        <td class="px-2" width="40%"><span class="dari-tanggal">{{ Carbon\Carbon::parse($start)->format('d-m-Y') }}</span></td>
                        <!-- <td width="20%">&nbsp;</td> -->
                        <td class="px-2" width="15%">NOMOR AKUN</td>
                        <td class="px-2" width="30%"><span class="akun-id">{{ $info_akun['kode'] ? $info_akun['kode']: 'Semua'  }}</span></td>
                    </tr>
                    <tr>
                        <td class="px-2" width="15%">SAMPAI TANGGAL</td>
                        <td class="px-2" width="40%"><span class="sampai-tanggal">{{ Carbon\Carbon::parse($end)->format('d-m-Y') }}</span></td>
                        <!-- <td width="20%">&nbsp;</td> -->
                        <td class="px-2" width="15%">AKUN</td>
                        <td class="px-2" width="30%"><span class="akun-id">{{ $info_akun['nama'] ? $info_akun['nama'] : 'Semua' }}</span></td>
                    </tr>
                </table>

                <table class="table table-bordered table-sm">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2" width="2%">No</th>
                            <th rowspan="2" width="13%">Tanggal</th>
                            <th rowspan="2" class="text-center" width="8%">Kode Akun</th>
                            <th rowspan="2">Akun</th>
                            <th rowspan="2">Keterangan</th>
                            <th colspan="2">Jenis</th>
                            <!-- <th rowspan="2">Keterangan</th> -->
                        </tr>
                        <tr>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                            $pemasukan = 0;
                            $pengeluaran = 0;
                        @endphp
                        @foreach ($buku_besar as $buku)
                            <tr class="tr-{{ $buku->id }}">
                                <td>{{ ++$no }}</td>
                                <td>{{ $buku->tanggal_transaksi->isoFormat('D MMMM Y') }}</td>
                                <td class="text-center">{{ $buku->akun->kode_akun }}</td>
                                <td>{{ $buku->akun->nama_akun }}</td>
                                <td>{{ $buku->keterangan }}</td>
                                <td class="text-right">{{ $buku->pemasukan ? 'Rp. ' . number_format($buku->pemasukan, 0, ',', '.') : '' }}</td>
                                <td class="text-right">{{ $buku->pengeluaran ? 'Rp. ' . number_format($buku->pengeluaran, 0, ',', '.') : ''  }}</td>
                                <!-- <td>{{ $buku->keterangan }}</td> -->
                            </tr>
                            @php
                                $pemasukan += $buku->pemasukan;
                                $pengeluaran += $buku->pengeluaran;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-right">TOTAL</td>
                            <td class="text-right">Rp. {{ number_format($pemasukan, 0, ',', '.') }}</td>
                            <td class="text-right">RP. {{ number_format($pengeluaran, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="5" class="text-right">SALDO</td>
                            <td class="text-center" colspan="2">Rp. {{ number_format($pemasukan  - $pengeluaran, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
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
      templateResult: formatAkun,
      placeholder: "Semua Akun"
    })

    //Date range as a button
    moment.locale('id');

    $('#daterange-btn-end').daterangepicker({
        singleDatePicker: true,
        autoApply:true,
        minDate: $('#daterange-btn').val()
    }, function(start, end){
        $('#sampai-tanggal').val(start.format('YYYY-MM-DD'))
    })

    $('#daterange-btn-end').val("{{ Carbon\Carbon::parse($end)->format('d/m/Y') }}")

    $('#daterange-btn').daterangepicker({
        singleDatePicker: true,
        autoApply:true,
    }, function(start, end){
        $('#dari-tanggal').val(start.format('YYYY-MM-DD'))
        console.log(start.format('YYYY-MM-DD'))
        // console.log($('#daterange-btn-end').data('daterangepicker'))
        $('#daterange-btn-end').data('daterangepicker').minDate = moment($('#dari-tanggal').val())
    })

    $('#daterange-btn').val("{{ Carbon\Carbon::parse($start)->format('d/m/Y') }}")

    $('#akun_id').val("{{ $akun_id }}").trigger('change')

    $('#daterange-btn-n').daterangepicker(
      {
        ranges   : {
          'Hari ini'       : [moment(), moment()],
          'Kemarin'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //   'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        //   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'Bulan ini'  : [moment().startOf('month'), moment().endOf('month')],
          'Bulan Kemarin'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        console.log(start.format('DMMYYYY'))
        console.log(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        if (start.format('DMMYYYY') == end.format('DMMYYYY')) {
            $('.tanggal-laporan span').html(start.format('D MMMM YYYY'))
        } else {
            $('.tanggal-laporan span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'))
        }

        $('.dari-tanggal').html(start.format('D MMMM YYYY'))
        $('.sampai-tanggal').html(end.format('D MMMM YYYY'))
        $('#dari-tanggal').val(start.format('YYYY-MM-DD'))
        $('#sampai-tanggal').val(end.format('YYYY-MM-DD'))
      }
    )


    </script>

    <script>
    function lihatSemua() {
        const form = document.getElementById('form-laporan')
        $('#akun_id').val('')
        form.submit()
    }   
    </script>
@endpush