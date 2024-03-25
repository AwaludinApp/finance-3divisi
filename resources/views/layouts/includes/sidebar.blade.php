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

<!-- Main Sidebar Container -->
<!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light show-small"> -->
    <!-- Left navbar links -->
    <!-- <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
</nav> -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <span class="brand-text font-weight-light">Aplikasi Keuangan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      @php
      $current = Route::currentRouteName();
      // print_r($current);
      @endphp
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ $current == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kategori.index') }}" class="nav-link {{ $current == 'kategori.index' ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Akun
              </p>
            </a>
          </li>
          @if (in_array(Auth::user()->role, [1,2, 3, 5]))
          <li class="nav-item {{ in_array($current, ['buku_besar.index', 'buku_kecil.index']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array($current, ['buku_besar.index', 'buku_kecil.index']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if (in_array(Auth::user()->role, [1,2]))   
              <li class="nav-item">
                <a href="{{ route('buku_besar.index') }}" class="nav-link {{ in_array($current, ['buku_besar.index']) ? 'active' : '' }}">
                  <i class="fas fa-columns nav-icon"></i>
                  <p>Service</p>
                </a>
              </li>
            @endif
            @if (in_array(Auth::user()->role, [1,3]))     
              <li class="nav-item">
                <a href="{{ route('buku_kecil.index') }}" class="nav-link {{ in_array($current, ['buku_kecil.index']) ? 'active' : '' }}">
                  <i class="fas fa-columns nav-icon"></i>
                  <p>Sparepart</p>
                </a>
              </li>
              @endif
              @if (in_array(Auth::user()->role, [1,5]))     
              <li class="nav-item">
                <a href="{{ route('second.index') }}" class="nav-link {{ in_array($current, ['second.index']) ? 'active' : '' }}">
                  <i class="fas fa-columns nav-icon"></i>
                  <p>Second</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          <li class="nav-item {{ in_array($current, ['laporan_buku_besar.index', 'laporan_buku_kecil.index', 'laporan_second.index', 'laporan_gabungan.index']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array($current, ['laporan_buku_besar.index', 'laporan_buku_kecil.index', 'laporan_second.index', 'laporan_gabungan.index']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if (in_array(Auth::user()->role, [1,2,4]))
              <li class="nav-item">
                <a href="{{ route('laporan_buku_besar.index') }}" class="nav-link {{ in_array($current, ['laporan_buku_besar.index']) ? 'active' : '' }}">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>Service</p>
                </a>
              </li>
            @endif 
            @if (in_array(Auth::user()->role, [1,3,4]))
              <li class="nav-item">
                <a href="{{ route('laporan_buku_kecil.index') }}" class="nav-link {{ in_array($current, ['laporan_buku_kecil.index']) ? 'active' : '' }}">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>Sparepart</p>
                </a>
              </li>
              @endif
              @if (in_array(Auth::user()->role, [1,5,4]))
              <li class="nav-item">
                <a href="{{ route('laporan_second.index') }}" class="nav-link {{ in_array($current, ['laporan_second.index']) ? 'active' : '' }}">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>Second</p>
                </a>
              </li>
              @endif
              @if (in_array(Auth::user()->role, [1,4]))  
              <li class="nav-item">
              <a href="{{ route('laporan_gabungan.index') }}" class="nav-link {{ in_array($current, ['laporan_gabungan.index']) ? 'active' : '' }}">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>Gabungan</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @if (Auth::user()->role == 1)   
          <li class="nav-item">
            <a href="{{ route('pengguna.index') }}" class="nav-link {{ in_array($current, ['pengguna.index']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
