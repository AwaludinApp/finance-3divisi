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
<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Kas</title>
        <style>
            body {
                font-size: 0.6em !important;
            }
            table.table {
                border: 1px solid black;
                border-collapse: collapse;
            }
            table.table tr td, table.table tr th {
                border: 1px solid black;
                padding: 4px 8px 4px 8px;
            }
            table.header tr td, table.header tr th {
                padding: 0px;
                border-collapse: collapse;
            }
            .text-right {
                text-align: right !important;
            }
            .text-center {
                text-align: center !important;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <!-- /.card-header -->
                        <div class="report-body">
                        <table style="width:100%;margin-bottom:8px;">
                            <tr>    
                            <td class="text-center" style="font-size:1.5em;line-height:1em;">
                                <p>LAPORAN KEUANGAN<br>
                               
                                KAS<br>
                            </td>
                            </tr>
                        </table>    
                        <table style="width:100%;margin-bottom:8px;" class="table table-bordered table-sm mb-4">    
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

                        <table style="width:100%;" class="table table-bordered table-sm">
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
                                @foreach ($gabungan as $buku)
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
                                    <td class="text-right">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</td>
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
    </body>
</html>