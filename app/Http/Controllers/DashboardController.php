<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use App\Models\BukuKecil;
use App\Models\Second;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $title = 'Dashboard';
        return view('pages.dashboard.index', compact('title'));     
    }

    public function pemasukan_hari_ini()
    {
        $role = Auth::user()->role;
        // role
        $today = date('Y-m-d');

        if ($role == 2) {
            $transaksi = BukuBesar::select('pemasukan')->where('is_deleted', 0)
                ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                // ->where('user_id', Auth::id()); 
        } elseif ($role == 3) {
            $transaksi = BukuKecil::select('pemasukan')->where('is_deleted', 0)
                ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                // ->where('user_id', Auth::id());
        } elseif ($role == 5) {
            $transaksi = Second::select('pemasukan')->where('is_deleted', 0)
                ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                // ->where('user_id', Auth::id());
        } else {
            if (in_array($role, [1,4])) {
                $buku_besar = BukuBesar::select('pemasukan')->where('is_deleted', 0)
                    ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                $second = Second::select('pemasukan')->where('is_deleted', 0)
                    ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                $transaksi = BukuKecil::select('pemasukan')->where('is_deleted', 0)
                   ->whereRaw("date(tanggal_transaksi) = '" . $today . "'")
                    ->union($buku_besar)
                    ->union($second);
            }
        }

        $pemasukan_hari_ini = $transaksi
            ->sum('pemasukan');

        return [
            'result' => number_format($pemasukan_hari_ini, 0, ',', '.')
        ];
    }

    public function pemasukan_bulan_ini()
    {
        $role = Auth::user()->role;
        // role
        $today = date('Y-m-d');

        if ($role == 2) {
            $transaksi = BukuBesar::select('pemasukan')->where('is_deleted', 0)
                ->whereRaw("month(tanggal_transaksi) = month(now())")
                ->whereRaw("year(tanggal_transaksi) = year(now())");
                // ->where('user_id', Auth::id()); 
        } elseif ($role == 3) {
            $transaksi = BukuKecil::select('pemasukan')->where('is_deleted', 0)
            ->whereRaw("month(tanggal_transaksi) = month(now())")
            ->whereRaw("year(tanggal_transaksi) = year(now())");
            // ->where('user_id', Auth::id());
        } elseif ($role == 5) {
            $transaksi = Second::select('pemasukan')->where('is_deleted', 0)
            ->whereRaw("month(tanggal_transaksi) = month(now())")
            ->whereRaw("year(tanggal_transaksi) = year(now())");
            // ->where('user_id', Auth::id());
        } else {
            if (in_array($role, [1,4])) {
                $buku_besar = BukuBesar::select('pemasukan')->where('is_deleted', 0)
                    ->whereRaw("month(tanggal_transaksi) = month(now())")
                    ->whereRaw("year(tanggal_transaksi) = year(now())");
                $second = Second::select('pemasukan')->where(~'is_deleted', 0)
                    ->whereRaw("month(tanggal_transaksi) = month(now())")
                    ->whereRaw("year(tanggal_transaksi) = year(now())");    
                $transaksi = BukuKecil::select('pemasukan')->where('is_deleted', 0)
                    ->whereRaw("month(tanggal_transaksi) = month(now())")
                    ->whereRaw("year(tanggal_transaksi) = year(now())")
                    ->union($buku_besar)
                    ->union($second);
            }
        }

        $pemasukan_bulan_ini = $transaksi
            ->sum('pemasukan');

        return [
            'result' => number_format($pemasukan_bulan_ini, 0, ',', '.')
        ];
    }

    public function pemasukan_tahun_ini()
    {
        $role = Auth::user()->role;
        // role
        $today = date('Y-m-d');

        if ($role == 2) {
            $transaksi = BukuBesar::select('pemasukan')->where('is_deleted', 0)
                ->whereRaw("year(tanggal_transaksi) = year(now())");
                // ->where('user_id', Auth::id()); 
        } elseif ($role == 3) {
            $transaksi = BukuKecil::select('pemasukan')->where('is_deleted', 0)
            ->whereRaw("year(tanggal_transaksi) = year(now())");
            // ->where('user_id', Auth::id());
        } elseif ($role == 5) {
            $transaksi = Second::select('pemasukan')->where('is_deleted', 0)
            ->whereRaw("year(tanggal_transaksi) = year(now())");
            // ->where('user_id', Auth::id());
        } else {
            if (in_array($role, [1,4])) {
                $buku_besar = BukuBesar::select('pemasukan')->where('is_deleted', 0)
                    ->whereRaw("year(tanggal_transaksi) = year(now())");
                $second = Second::select('pemasukan')->where('is_deleted', 0)
                    ->whereRaw("year(tanggal_transaksi) = year(now())");    
                $transaksi = BukuKecil::select('pemasukan')->where('is_deleted', 0)
                    ->whereRaw("year(tanggal_transaksi) = year(now())")
                    ->union($buku_besar)
                    ->union($second);
            }
        }

        $pemasukan_tahun_ini = $transaksi
            ->sum('pemasukan');

        return [
            'result' => number_format($pemasukan_tahun_ini, 0, ',', '.')
        ];
    }

    public function seluruh_pemasukan()
    {
        $role = Auth::user()->role;
        // role
        $today = date('Y-m-d');

        if ($role == 2) {
            $transaksi = BukuBesar::select('pemasukan')->where('is_deleted', 0);
                // ->where('user_id', Auth::id()); 
        } elseif ($role == 3) {
            $transaksi = BukuKecil::select('pemasukan')->where('is_deleted', 0);
                // ->where('user_id', Auth::id());
        } elseif ($role == 5) {
            $transaksi = Second::select('pemasukan')->where('is_deleted', 0);
                // ->where('user_id', Auth::id());
        } else {
            if (in_array($role, [1,4])) {
                $buku_besar = BukuBesar::select('pemasukan')->where('is_deleted', 0);
                $second = Second::select('pemasukan')->where('is_deleted', 0);
                $transaksi = BukuKecil::select('pemasukan')->where('is_deleted', 0)
                        ->union($buku_besar)
                        ->union($second);
            }
        }

        $seluruh_pemasukan = $transaksi
            ->sum('pemasukan');

        return [
            'result' => number_format($seluruh_pemasukan, 0, ',', '.')
        ];
    }

    public function pengeluaran_hari_ini()
    {
        $role = Auth::user()->role;
        // role
        $today = date('Y-m-d');

        if ($role == 2) {
            $transaksi = BukuBesar::select('pengeluaran')->where('is_deleted', 0)
                ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                // ->where('user_id', Auth::id()); 
        } elseif ($role == 3) {
            $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
                ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                // ->where('user_id', Auth::id());
        } elseif ($role == 5) {
            $transaksi = Second::select('pengeluaran')->where('is_deleted', 0)
                ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                // ->where('user_id', Auth::id());
        } else {
            if (in_array($role, [1,4])) {
                $buku_besar = BukuBesar::select('pengeluaran')->where('is_deleted', 0)
                    ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                $second = Second::select('pengeluaran')->where('is_deleted', 0)
                    ->whereRaw("date(tanggal_transaksi) = '" . $today . "'");
                $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
                   ->whereRaw("date(tanggal_transaksi) = '" . $today . "'")
                    ->union($buku_besar)
                    ->union($second);
            }
        }

        $pengeluaran_hari_ini = $transaksi
            ->sum('pengeluaran');

        return [
            'result' => number_format($pengeluaran_hari_ini, 0, ',', '.')
        ];
    }

    public function pengeluaran_bulan_ini()
    {
        $role = Auth::user()->role;
        // role
        $today = date('Y-m-d');

        if ($role == 2) {
            $transaksi = BukuBesar::select('pengeluaran')->where('is_deleted', 0)
                ->whereRaw("month(tanggal_transaksi) = month(now())")
                ->whereRaw("year(tanggal_transaksi) = year(now())");
                // ->where('user_id', Auth::id()); 
        } elseif ($role == 3) {
            $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
            ->whereRaw("month(tanggal_transaksi) = month(now())")
            ->whereRaw("year(tanggal_transaksi) = year(now())");
            // ->where('user_id', Auth::id());
        } elseif ($role == 5) {
            $transaksi = Second::select('pengeluaran')->where('is_deleted', 0)
            ->whereRaw("month(tanggal_transaksi) = month(now())")
            ->whereRaw("year(tanggal_transaksi) = year(now())");
            // ->where('user_id', Auth::id());
        } else {
            if (in_array($role, [1,4])) {
                $buku_besar = BukuBesar::select('pengeluaran')->where('is_deleted', 0)
                    ->whereRaw("month(tanggal_transaksi) = month(now())")
                    ->whereRaw("year(tanggal_transaksi) = year(now())");
                $second = Second::select('pengeluaran')->where('is_deleted', 0)
                    ->whereRaw("month(tanggal_transaksi) = month(now())")
                    ->whereRaw("year(tanggal_transaksi) = year(now())");
                $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
                    ->whereRaw("month(tanggal_transaksi) = month(now())")
                    ->whereRaw("year(tanggal_transaksi) = year(now())")
                    ->union($buku_besar)
                    ->union($second);
            }
        }

        $pengeluaran_bulan_ini = $transaksi
            ->sum('pengeluaran');

        return [
            'result' => number_format($pengeluaran_bulan_ini, 0, ',', '.')
        ];
    }

    public function pengeluaran_tahun_ini()
    {
        $role = Auth::user()->role;
        // role
        $today = date('Y-m-d');

        if ($role == 2) {
            $transaksi = BukuBesar::select('pengeluaran')->where('is_deleted', 0)
                ->whereRaw("year(tanggal_transaksi) = year(now())");
                // ->where('user_id', Auth::id()); 
        } elseif ($role == 3) {
            $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
            ->whereRaw("year(tanggal_transaksi) = year(now())");
            // ->where('user_id', Auth::id());
        } elseif ($role == 5) {
            $transaksi = Second::select('pengeluaran')->where('is_deleted', 0)
            ->whereRaw("year(tanggal_transaksi) = year(now())");
            // ->where('user_id', Auth::id());
        } else {
            if (in_array($role, [1,4])) {
                $buku_besar = BukuBesar::select('pengeluaran')->where('is_deleted', 0)
                    ->whereRaw("year(tanggal_transaksi) = year(now())");
                $second = Second::select('pengeluaran')->where('is_deleted', 0)
                    ->whereRaw("year(tanggal_transaksi) = year(now())");
                $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
                    ->whereRaw("year(tanggal_transaksi) = year(now())")
                    ->union($buku_besar)
                    ->union($second);
            }
        }

        $pengeluaran_tahun_ini = $transaksi
            ->sum('pengeluaran');

        return [
            'result' => number_format($pengeluaran_tahun_ini, 0, ',', '.')
        ];
    }

    public function seluruh_pengeluaran()
    {
        $role = Auth::user()->role;
        // role
        $today = date('Y-m-d');

        if ($role == 2) {
            $transaksi = BukuBesar::select('pengeluaran')->where('is_deleted', 0);
                // ->where('user_id', Auth::id()); 
        } elseif ($role == 3) {
            $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0);
                // ->where('user_id', Auth::id());
        } elseif ($role == 5) {
            $transaksi = Second::select('pengeluaran')->where('is_deleted', 0);
                // ->where('user_id', Auth::id());
        } else {
            if (in_array($role, [1,4])) {
                $buku_besar = BukuBesar::select('pengeluaran')->where('is_deleted', 0);
                $econd = Second::select('pengeluaran')->where('is_deleted', 0);
                $second = Second::select('pengeluaran')->where('is_deleted', 0);
                $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
                    ->union($buku_besar)
                    ->union($second);
            }
        }

        $seluruh_pengeluaran = $transaksi
            ->sum('pengeluaran');

        return [
            'result' => number_format($seluruh_pengeluaran, 0, ',', '.')
        ];
    }

    public function data_bulan_tahun_ini()
    {
        $data = [];
        $options = [];

        $role = Auth::user()->role;

        $pemasukan = [0,0,0,0,0,0,0,0,0,0,0,0,0];

        $pengeluaran = [0,0,0,0,0,0,0,0,0,0,0,0,0];

        if ($role == 2) {
            // $transaksi = BukuBesar::select('pengeluaran')->where('is_deleted', 0)
            //     ->where('user_id', Auth::id()); 
            $buku_besar_pemasukan = BukuBesar::selectRaw('month(tanggal_transaksi) as bln, SUM(pemasukan) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("month(tanggal_transaksi)")
                ->get();

            foreach($buku_besar_pemasukan as $bbpemasukan) {
                if (isset($pemasukan[$bbpemasukan->bln - 1])) {
                    $pemasukan[$bbpemasukan->bln - 1] += $bbpemasukan->masuk;
                } else {
                    $pemasukan[$bbpemasukan->bln - 1] = $bbpemasukan->masuk;
                }
            }

            $buku_besar_pengeluaran = BukuBesar::selectRaw('month(tanggal_transaksi) as bln, SUM(pengeluaran) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("month(tanggal_transaksi)")
                ->get();

            foreach($buku_besar_pengeluaran as $bbpengeluaran) {
                if (isset($pengeluaran[$bbpengeluaran->bln - 1])) {
                    $pengeluaran[$bbpengeluaran->bln - 1] += $bbpengeluaran->masuk;
                } else {
                    $pengeluaran[$bbpengeluaran->bln - 1] = $bbpengeluaran->masuk;
                }
            }    
        } elseif ($role == 3) {
            // $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
            //     ->where('user_id', Auth::id());

            $buku_kecil_pemasukan = BukuKecil::selectRaw('month(tanggal_transaksi) as bln, SUM(pemasukan) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("month(tanggal_transaksi)")
                ->get();

            foreach($buku_kecil_pemasukan as $bkpemasukan) {
                if (isset($pemasukan[$bkpemasukan->bln - 1])) {
                    $pemasukan[$bkpemasukan->bln - 1] += $bkpemasukan->masuk;
                } else {
                    $pemasukan[$bkpemasukan->bln - 1] = $bkpemasukan->masuk;
                }
            }

            $buku_kecil_pengeluaran = BukuKecil::selectRaw('month(tanggal_transaksi) as bln, SUM(pengeluaran) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("month(tanggal_transaksi)")
                ->get();

            foreach($buku_kecil_pengeluaran as $bkpengeluaran) {
                if (isset($pengeluaran[$bkpengeluaran->bln - 1])) {
                    $pengeluaran[$bkpengeluaran->bln - 1] += $bkpengeluaran->masuk;
                } else {
                    $pengeluaran[$bkpengeluaran->bln - 1] = $bkpengeluaran->masuk;
                }
            }    
        } elseif ($role == 5) {
            // $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
            //     ->where('user_id', Auth::id());

            $buku_second_pemasukan = Second::selectRaw('month(tanggal_transaksi) as bln, SUM(pemasukan) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("month(tanggal_transaksi)")
                ->get();

            foreach($buku_second_pemasukan as $bkpemasukan) {
                if (isset($pemasukan[$bkpemasukan->bln - 1])) {
                    $pemasukan[$bkpemasukan->bln - 1] += $bkpemasukan->masuk;
                } else {
                    $pemasukan[$bkpemasukan->bln - 1] = $bkpemasukan->masuk;
                }
            }

            $buku_second_pengeluaran = Second::selectRaw('month(tanggal_transaksi) as bln, SUM(pengeluaran) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("month(tanggal_transaksi)")
                ->get();

            foreach($buku_second_pengeluaran as $bkpengeluaran) {
                if (isset($pengeluaran[$bkpengeluaran->bln - 1])) {
                    $pengeluaran[$bkpengeluaran->bln - 1] += $bkpengeluaran->masuk;
                } else {
                    $pengeluaran[$bkpengeluaran->bln - 1] = $bkpengeluaran->masuk;
                }
            }    
        } else {
            if (in_array($role, [1,4])) {
                // $buku_besar = BukuBesar::selectRaw('month(tanggal_transaksi) as bln, SUM(pemasukan) as masuk')
                //     ->where('is_deleted', 0)
                //     ->groupByRaw();
                // $pemasukan = BukuKecil::selectRaw('month(tanggal_transaksi) as bln, SUM(pemasukan) as masuk')
                //     ->where('is_deleted', 0)
                //     ->union($buku_besar)
                //     ->groupByRaw("month(tanggal_transaksi)");

                // $buku_besar = BukuBesar::select('pengeluaran')->where('is_deleted', 0);
                // $pengeluaran = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
                //     ->union($buku_besar)
                //     ->groupByRaw("month('tanggal_transaksi')");

                $buku_besar_pemasukan = BukuBesar::selectRaw('month(tanggal_transaksi) as bln, SUM(pemasukan) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("month(tanggal_transaksi)")
                    ->get();

                $buku_second_pemasukan = Second::selectRaw('month(tanggal_transaksi) as bln, SUM(pemasukan) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("month(tanggal_transaksi)")
                    ->get();    

                $buku_kecil_pemasukan = BukuKecil::selectRaw('month(tanggal_transaksi) as bln, SUM(pemasukan) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("month(tanggal_transaksi)")
                    ->get();

                foreach($buku_besar_pemasukan as $bbpemasukan) {
                    $pemasukan[$bbpemasukan->bln - 1] = $bbpemasukan->masuk;
                } 

                foreach($buku_kecil_pemasukan as $bkpemasukan) {
                    if (isset($pemasukan[$bkpemasukan->bln - 1])) {
                        $pemasukan[$bkpemasukan->bln - 1] += $bkpemasukan->masuk;
                    } else {
                        $pemasukan[$bkpemasukan->bln - 1] = $bkpemasukan->masuk;
                    }
                }

                foreach($buku_second_pemasukan as $bkpemasukan) {
                    if (isset($pemasukan[$bkpemasukan->bln - 1])) {
                        $pemasukan[$bkpemasukan->bln - 1] += $bkpemasukan->masuk;
                    } else {
                        $pemasukan[$bkpemasukan->bln - 1] = $bkpemasukan->masuk;
                    }
                }

                $buku_besar_pengeluaran = BukuBesar::selectRaw('month(tanggal_transaksi) as bln, SUM(pengeluaran) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("month(tanggal_transaksi)")
                    ->get();

                $buku_second_pengeluaran = Second::selectRaw('month(tanggal_transaksi) as bln, SUM(pengeluaran) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("month(tanggal_transaksi)")
                    ->get();    

                $buku_kecil_pengeluaran = BukuKecil::selectRaw('month(tanggal_transaksi) as bln, SUM(pengeluaran) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("month(tanggal_transaksi)")
                    ->get();

                foreach($buku_besar_pengeluaran as $bbpengeluaran) {
                    $pengeluaran[$bbpengeluaran->bln - 1] = $bbpengeluaran->masuk;
                } 

                foreach($buku_kecil_pengeluaran as $bkpengeluaran) {
                    if (isset($pengeluaran[$bkpengeluaran->bln - 1])) {
                        $pengeluaran[$bkpengeluaran->bln - 1] += $bkpengeluaran->masuk;
                    } else {
                        $pengeluaran[$bkpengeluaran->bln - 1] = $bkpengeluaran->masuk;
                    }
                }
                
                foreach($buku_second_pengeluaran as $bkpengeluaran) {
                    if (isset($pengeluaran[$bkpengeluaran->bln - 1])) {
                        $pengeluaran[$bkpengeluaran->bln - 1] += $bkpengeluaran->masuk;
                    } else {
                        $pengeluaran[$bkpengeluaran->bln - 1] = $bkpengeluaran->masuk;
                    }
                }
            }
        }

        $data = [
            'labels' => ["Januari", "Februari", 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $pemasukan,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                    // 'backgroundColor' => 'background_2',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $pengeluaran,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1
                ],
            ]
        ];

        return response()->json([
            'data' => $data,
        ]);
    }

    public function data_tahunan()
    {
        $data = [];
        $options = [];

        $role = Auth::user()->role;

        $pemasukan = [0,0,0,0,0,0,0,0,0,0,0,0,0];

        $pengeluaran = [0,0,0,0,0,0,0,0,0,0,0,0,0];

        $start = 2023;
        $end = date('Y');

        $year = [];
        $arr = 0;
        $years = [];
        for($i=$start;$i<=$end;$i++) {
            $year[$i] = $arr;
            $years[] = $i;
            $arr++;
        }

        if ($role == 2) {
            // $transaksi = BukuBesar::select('pengeluaran')->where('is_deleted', 0)
            //     ->where('user_id', Auth::id()); 
            $buku_besar_pemasukan = BukuBesar::selectRaw('year(tanggal_transaksi) as tahun, SUM(pemasukan) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("year(tanggal_transaksi)")
                ->get();

            foreach($buku_besar_pemasukan as $bbpemasukan) {
                if (isset($pemasukan[$year[$bbpemasukan->tahun]])) {
                    $pemasukan[$year[$bbpemasukan->tahun]] += $bbpemasukan->masuk;
                } else {
                    $pemasukan[$year[$bbpemasukan->tahun]] = $bbpemasukan->masuk;
                }
            }

            $buku_besar_pengeluaran = BukuBesar::selectRaw('year(tanggal_transaksi) as tahun, SUM(pengeluaran) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("year(tanggal_transaksi)")
                ->get();

            foreach($buku_besar_pengeluaran as $bbpengeluaran) {
                if (isset($pengeluaran[$year[$bbpengeluaran->tahun]])) {
                    $pengeluaran[$year[$bbpengeluaran->tahun]] += $bbpengeluaran->masuk;
                } else {
                    $pengeluaran[$year[$bbpengeluaran->tahun]] = $bbpengeluaran->masuk;
                }
            }    
        } elseif ($role == 3) {
            // $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
            //     ->where('user_id', Auth::id());

            $buku_kecil_pemasukan = BukuKecil::selectRaw('year(tanggal_transaksi) as tahun, SUM(pemasukan) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("year(tanggal_transaksi)")
                ->get();

            foreach($buku_kecil_pemasukan as $bkpemasukan) {
                if (isset($pemasukan[$year[$bkpemasukan->tahun]])) {
                    $pemasukan[$year[$bkpemasukan->tahun]] += $bkpemasukan->masuk;
                } else {
                    $pemasukan[$year[$bkpemasukan->tahun]] = $bkpemasukan->masuk;
                }
            }

            $buku_kecil_pengeluaran = BukuKecil::selectRaw('year(tanggal_transaksi) as tahun, SUM(pengeluaran) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("year(tanggal_transaksi)")
                ->get();

            foreach($buku_kecil_pengeluaran as $bkpengeluaran) {
                if (isset($pengeluaran[$year[$bkpengeluaran->tahun]])) {
                    $pengeluaran[$year[$bkpengeluaran->tahun]] += $bkpengeluaran->masuk;
                } else {
                    $pengeluaran[$year[$bkpengeluaran->tahun]] = $bkpengeluaran->masuk;
                }
            }    
        } elseif ($role == 5) {
            // $transaksi = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
            //     ->where('user_id', Auth::id());

            $buku_second_pemasukan = Second::selectRaw('year(tanggal_transaksi) as tahun, SUM(pemasukan) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("year(tanggal_transaksi)")
                ->get();

            foreach($buku_second_pemasukan as $bkpemasukan) {
                if (isset($pemasukan[$year[$bkpemasukan->tahun]])) {
                    $pemasukan[$year[$bkpemasukan->tahun]] += $bkpemasukan->masuk;
                } else {
                    $pemasukan[$year[$bkpemasukan->tahun]] = $bkpemasukan->masuk;
                }
            }

            $buku_second_pengeluaran = Second::selectRaw('year(tanggal_transaksi) as tahun, SUM(pengeluaran) as masuk')
                ->where('is_deleted', 0)
                // ->where('user_id', Auth::id())
                ->groupByRaw("year(tanggal_transaksi)")
                ->get();

            foreach($buku_second_pengeluaran as $bkpengeluaran) {
                if (isset($pengeluaran[$year[$bkpengeluaran->tahun]])) {
                    $pengeluaran[$year[$bkpengeluaran->tahun]] += $bkpengeluaran->masuk;
                } else {
                    $pengeluaran[$year[$bkpengeluaran->tahun]] = $bkpengeluaran->masuk;
                }
            }    
        } else {
            if (in_array($role, [1,4])) {
                // $buku_besar = BukuBesar::selectRaw('year(tanggal_transaksi) as tahun, SUM(pemasukan) as masuk')
                //     ->where('is_deleted', 0)
                //     ->groupByRaw();
                // $pemasukan = BukuKecil::selectRaw('year(tanggal_transaksi) as tahun, SUM(pemasukan) as masuk')
                //     ->where('is_deleted', 0)
                //     ->union($buku_besar)
                //     ->groupByRaw("year(tanggal_transaksi)");

                // $buku_besar = BukuBesar::select('pengeluaran')->where('is_deleted', 0);
                // $pengeluaran = BukuKecil::select('pengeluaran')->where('is_deleted', 0)
                //     ->union($buku_besar)
                //     ->groupByRaw("year('tanggal_transaksi')");

                $buku_besar_pemasukan = BukuBesar::selectRaw('year(tanggal_transaksi) as tahun, SUM(pemasukan) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("year(tanggal_transaksi)")
                    ->get();

                $buku_kecil_pemasukan = BukuKecil::selectRaw('year(tanggal_transaksi) as tahun, SUM(pemasukan) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("year(tanggal_transaksi)")
                    ->get();

                $buku_second_pemasukan = Second::selectRaw('year(tanggal_transaksi) as tahun, SUM(pemasukan) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("year(tanggal_transaksi)")
                    ->get();    

                foreach($buku_besar_pemasukan as $bbpemasukan) {
                    $pemasukan[$year[$bbpemasukan->tahun]] = $bbpemasukan->masuk;
                } 

                foreach($buku_kecil_pemasukan as $bkpemasukan) {
                    if (isset($pemasukan[$year[$bkpemasukan->tahun]])) {
                        $pemasukan[$year[$bkpemasukan->tahun]] += $bkpemasukan->masuk;
                    } else {
                        $pemasukan[$year[$bkpemasukan->tahun]] = $bkpemasukan->masuk;
                    }
                }

                foreach($buku_second_pemasukan as $bkpemasukan) {
                    if (isset($pemasukan[$year[$bkpemasukan->tahun]])) {
                        $pemasukan[$year[$bkpemasukan->tahun]] += $bkpemasukan->masuk;
                    } else {
                        $pemasukan[$year[$bkpemasukan->tahun]] = $bkpemasukan->masuk;
                    }
                }

                $buku_besar_pengeluaran = BukuBesar::selectRaw('year(tanggal_transaksi) as tahun, SUM(pengeluaran) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("year(tanggal_transaksi)")
                    ->get();

                $buku_kecil_pengeluaran = BukuKecil::selectRaw('year(tanggal_transaksi) as tahun, SUM(pengeluaran) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("year(tanggal_transaksi)")
                    ->get();

                $buku_second_pengeluaran = Second::selectRaw('year(tanggal_transaksi) as tahun, SUM(pengeluaran) as masuk')
                    ->where('is_deleted', 0)
                    ->groupByRaw("year(tanggal_transaksi)")
                    ->get();    

                foreach($buku_besar_pengeluaran as $bbpengeluaran) {
                    $pengeluaran[$year[$bbpengeluaran->tahun]] = $bbpengeluaran->masuk;
                } 

                foreach($buku_kecil_pengeluaran as $bkpengeluaran) {
                    if (isset($pengeluaran[$year[$bkpengeluaran->tahun]])) {
                        $pengeluaran[$year[$bkpengeluaran->tahun]] += $bkpengeluaran->masuk;
                    } else {
                        $pengeluaran[$year[$bkpengeluaran->tahun]] = $bkpengeluaran->masuk;
                    }
                }
                
                foreach($buku_second_pengeluaran as $bkpengeluaran) {
                    if (isset($pengeluaran[$year[$bkpengeluaran->tahun]])) {
                        $pengeluaran[$year[$bkpengeluaran->tahun]] += $bkpengeluaran->masuk;
                    } else {
                        $pengeluaran[$year[$bkpengeluaran->tahun]] = $bkpengeluaran->masuk;
                    }
                }
            }
        }

        $data = [
            'labels' => $years,
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $pemasukan,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $pengeluaran,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1
                ],
            ]
        ];

        return response()->json([
            'data' => $data,
        ]);

    }
}
