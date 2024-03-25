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

@section('contents')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info-dash">
              <div class="inner">
                <h3><small><sup>Rp</sup></small><span id="pemasukan_hari_ini">0</span></h3>

                <p>Pemasukkan Hari Ini</p>
                <small>{{ Carbon\Carbon::now()->locale('id')->format('d-m-Y') }}</small>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-bag"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box fg-white bg-success-dash">
              <div class="inner">
                <h3><small><sup>Rp</sup></small><span id="pemasukan_bulan_ini">0</span></h3>

                <p>Pemasukan Bulan Ini</p>
                <small>{{ Carbon\Carbon::now()->locale('id')->format('M') }}</small>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning2-dash">
              <div class="inner">
                <h3><small><sup>Rp</sup></small><span id="pemasukan_tahun_ini">0</span></h3>

                <p>Pemasukan Tahun ini</p>
                <small>{{ Carbon\Carbon::now()->locale('id')->format('Y') }}</small>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success-dash">
              <div class="inner">
                <h3><small><sup>Rp</sup></small><span id="seluruh_pemasukan">0</span></h3>

                <p>Seluruh Pemasukan</p>
                <small>Semua</small>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning-dash">
              <div class="inner">
                <h3><small><sup>Rp</sup></small><span id="pengeluaran_hari_ini">0</span></h3>

                <p>Pengeluaran Hari Ini</p>
                <small>{{ Carbon\Carbon::now()->locale('id')->format('d-m-Y') }}</small>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger-dash">
              <div class="inner">
                <h3><small><sup>Rp</sup></small><span id="pengeluaran_bulan_ini">0</span></h3>

                <p>Pengeluaran Bulan Ini</p>
                <small>{{ Carbon\Carbon::now()->locale('id')->format('M') }}</small>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-bag"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info-dash">
              <div class="inner">
                <h3><small><sup>Rp</sup></small><span id="pengeluaran_tahun_ini">0</span></h3>

                <p>Pengeluaran Tahun Ini</p>
                <small>{{ Carbon\Carbon::now()->locale('id')->format('Y') }}</small>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger2-dash">
              <div class="inner">
                <h3><small><sup>Rp</sup></small><span id="seluruh_pengeluaran">0</span></h3>

                <p>Seluruh Pengeluaran</p>
                <small>Semua</small>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <div class="small-box" style="background:white;">
              <div class="px-4 py-4">
                <p>Grafik Keuangan per Bulan Tahun ini</p>
                <canvas id="myChart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-6">
            <div class="small-box" style="background:white;">
              <div class="px-4 py-4">
                <p>Grafik Keuangan per Tahun</p>
                <canvas id="myChart2" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
  <script>

    $.ajax({
      url:"{{ route('dashboard.pemasukan.hari.ini') }}",
      success: function(response) {
        $('#pemasukan_hari_ini').html(response.result)
      }
    })

    $.ajax({
      url:"{{ route('dashboard.pemasukan.bulan.ini') }}",
      success: function(response) {
        $('#pemasukan_bulan_ini').html(response.result)
      }
    })

    $.ajax({
      url:"{{ route('dashboard.pengeluaran.hari.ini') }}",
      success: function(response) {
        $('#pengeluaran_hari_ini').html(response.result)
      }
    })

    $.ajax({
      url:"{{ route('dashboard.pengeluaran.bulan.ini') }}",
      success: function(response) {
        $('#pengeluaran_bulan_ini').html(response.result)
      }
    })

    $.ajax({
      url:"{{ route('dashboard.pemasukan.tahun.ini') }}",
      success: function(response) {
        $('#pemasukan_tahun_ini').html(response.result)
      }
    })

    $.ajax({
      url:"{{ route('dashboard.pengeluaran.tahun.ini') }}",
      success: function(response) {
        $('#pengeluaran_tahun_ini').html(response.result)
      }
    })

  $('#seluruh_pemasukan').html("Memuat...")
    $.ajax({
      url:"{{ route('dashboard.seluruh.pemasukan') }}",
      success: function(response) {
        $('#seluruh_pemasukan').html(response.result)
      }
    })

    $('#seluruh_pengeluaran').html("Memuat...")
    $.ajax({
      url:"{{ route('dashboard.seluruh.pengeluaran') }}",
      success: function(response) {
        $('#seluruh_pengeluaran').html(response.result)
      }
    })


    $.ajax({
      url: "{{ route('dashboard.bulan.tahun.ini') }}",
      success: function(response) {
        var ctx = document.getElementById('myChart').getContext('2d');

        var background_1 = ctx.createLinearGradient(0, 0, 0, 600);

        background_1.addColorStop(0, 'red');
        background_1.addColorStop(1, 'blue');

        var background_2 = ctx.createLinearGradient(0, 0, 0, 600);
        background_2.addColorStop(0, 'green');
        background_2.addColorStop(1, 'orange');

        var background_3 = ctx.createLinearGradient(0, 0, 0, 600);
        background_3.addColorStop(0, 'orange');
        background_3.addColorStop(1, 'purple');

        var background_4 = ctx.createLinearGradient(0, 0, 0, 600);
        background_4.addColorStop(0, 'green');
        background_4.addColorStop(1, 'violet');


        var data = {
          type: 'bar',
          data: response.data,
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  callback: function(value, index, values) {
                    return value.toLocaleString("id-ID",{style:"currency", currency:"IDR"});
                  }
                }
              }]
            }
          }
        }

        var myChart = new Chart(ctx, data);

      }
    })

    $.ajax({
      url: "{{ route('dashboard.tahunan') }}",
      success: function(response) {
        var ctx = document.getElementById('myChart2').getContext('2d');

        var data = {
          type: 'bar',
          data: response.data,
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  callback: function(value, index, values) {
                    return value.toLocaleString("id-ID",{style:"currency", currency:"IDR"});
                  }
                }
              }]
            }
          }
        }

        var myChart2 = new Chart(ctx, data);

      }
    })


  </script>
@endpush