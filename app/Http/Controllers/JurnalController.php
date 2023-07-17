<?php

namespace App\Http\Controllers;

use App\Exports\JurnalExport;
use App\Models\Akun;
use App\Models\Jurnal;
use App\Models\proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JurnalImport;


class JurnalController extends Controller
{
    protected $tgl1, $tgl2, $id_proyek, $period, $id_buku;
    public function __construct(Request $r)
    {
        if (empty($r->period)) {
            $this->tgl1 = date('Y-m-01');
            $this->tgl2 = date('Y-m-t');
        } elseif ($r->period == 'daily') {
            $this->tgl1 = date('Y-m-d');
            $this->tgl2 = date('Y-m-d');
        } elseif ($r->period == 'weekly') {
            $this->tgl1 = date('Y-m-d', strtotime("-6 days"));
            $this->tgl2 = date('Y-m-d');
        } elseif ($r->period == 'mounthly') {
            $bulan = $r->bulan;
            $tahun = $r->tahun;
            $tglawal = "$tahun" . "-" . "$bulan" . "-" . "01";
            $tglakhir = "$tahun" . "-" . "$bulan" . "-" . "01";

            $this->tgl1 = date('Y-m-01', strtotime($tglawal));
            $this->tgl2 = date('Y-m-t', strtotime($tglakhir));
        } elseif ($r->period == 'costume') {
            $this->tgl1 = $r->tgl1;
            $this->tgl2 = $r->tgl2;
        } elseif ($r->period == 'years') {
            $tahun = $r->tahunfilter;
            $tgl_awal = "$tahun" . "-" . "01" . "-" . "01";
            $tgl_akhir = "$tahun" . "-" . "12" . "-" . "01";

            $this->tgl1 = date('Y-m-01', strtotime($tgl_awal));
            $this->tgl2 = date('Y-m-t', strtotime($tgl_akhir));
        }

        $this->id_proyek = $r->id_proyek ?? 0;
        $this->id_buku = $r->id_buku ?? 2;
    }

    public function index()
    {
        $tgl1 =  $this->tgl1;
        $tgl2 =  $this->tgl2;
        $id_proyek = $this->id_proyek;

        if ($id_proyek == '0') {
            $jurnal =  DB::select("SELECT a.id_jurnal,a.no_urut,a.admin, a.id_akun, a.tgl, a.debit, a.kredit, a.ket,a.no_nota, b.nm_akun, c.nm_post, d.nm_proyek FROM jurnal as a 
            left join akun as b on b.id_akun = a.id_akun
            left join tb_post_center as c on c.id_post_center = a.id_post_center
            left join proyek as d on d.id_proyek = a.id_proyek
            where a.id_buku = '2' and a.tgl between '$tgl1' and '$tgl2' order by a.id_jurnal DESC");
        } else {
            $jurnal =  DB::select("SELECT a.id_jurnal,a.no_urut,a.admin, a.id_akun, a.tgl, a.debit, a.kredit, a.ket,a.no_nota, b.nm_akun, c.nm_post,d.nm_proyek FROM jurnal as a 
            left join akun as b on b.id_akun = a.id_akun
            left join tb_post_center as c on c.id_post_center = a.id_post_center
            left join proyek as d on d.id_proyek = a.id_proyek
            where a.id_buku = '2' and a.id_proyek = $id_proyek and a.tgl between '$tgl1' and '$tgl2' order by a.id_jurnal DESC");
        }


        $data =  [
            'title' => 'Jurnal Umum',
            'jurnal' => $jurnal,
            'proyek' => proyek::where('status', 'berjalan')->get(),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'id_proyek' => $id_proyek

        ];
        return view('jurnal.index', $data);
    }

    public function add()
    {
        $max = DB::table('notas')->latest('nomor_nota')->first();

        if (empty($max)) {
            $nota_t = '1000';
        } else {
            $nota_t = $max->nomor_nota + 1;
        }
        $data =  [
            'title' => 'Jurnal Umum',
            'max' => $nota_t,
            'proyek' => proyek::where('status', 'berjalan')->get()

        ];
        return view('jurnal.add', $data);
    }

    public function load_menu()
    {
        $data =  [
            'title' => 'Jurnal Umum',
            'akun' => Akun::all(),
            'proyek' => proyek::all()

        ];
        return view('jurnal.load_menu', $data);
    }
    public function tambah_baris_jurnal(Request $r)
    {
        $data =  [
            'title' => 'Jurnal Umum',
            'akun' => Akun::all(),
            'count' => $r->count

        ];
        return view('jurnal.tbh_baris', $data);
    }

    public function save_jurnal(Request $r)
    {
        $tgl = $r->tgl;
        // $no_nota = $r->no_nota;
        $id_akun = $r->id_akun;
        $keterangan = $r->keterangan;
        $debit = $r->debit;
        $kredit = $r->kredit;
        $id_proyek = $r->id_proyek;
        $no_urut = $r->no_urut;
        $id_post = $r->id_post;

        $max = DB::table('notas')->latest('nomor_nota')->first();

        if (empty($max)) {
            $nota_t = '1000';
        } else {
            $nota_t = $max->nomor_nota + 1;
        }
        DB::table('notas')->insert(['nomor_nota' => $nota_t]);

        for ($i = 0; $i < count($id_akun); $i++) {
            $data = [
                'tgl' => $tgl,
                'no_nota' => 'JU-' . $nota_t,
                'id_akun' => $id_akun[$i],
                'id_buku' => '2',
                'ket' => $keterangan[$i],
                'debit' => $debit[$i],
                'kredit' => $kredit[$i],
                'admin' => Auth::user()->name,
                'no_dokumen' => $r->no_dokumen,
                'tgl_dokumen' => $r->tgl_dokumen,
                'id_proyek' => $id_proyek,
                'no_urut' => $no_urut[$i],
                'id_post_center' => $id_post[$i]
            ];
            Jurnal::create($data);
        }

        $tgl1 = date('Y-m-01', strtotime($r->tgl));
        $tgl2 = date('Y-m-t', strtotime($r->tgl));
        return redirect()->route('jurnal', ['period' => 'costume', 'tgl1' => $tgl1, 'tgl2' => $tgl2, 'id_proyek' => 0])->with('sukses', 'Data berhasil ditambahkan');
    }

    public function delete(Request $r)
    {
        $nomer = substr($r->no_nota, 3);
        DB::table('notas')->where('nomor_nota', $nomer)->delete();
        Jurnal::where('no_nota', $r->no_nota)->delete();

        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        $id_proyek = $r->id_proyek;
        return redirect()->route('jurnal', ['tgl1' => $tgl1, 'tgl2' => $tgl2, 'id_proyek' => $id_proyek])->with('sukses', 'Data berhasil dihapus');
    }

    public function export(Request $r)
    {
        $tgl1 =  $r->tgl1;
        $tgl2 =  $r->tgl2;

        $id_proyek = $this->id_proyek;

        if ($id_proyek == 0) {
            $total = DB::selectOne("SELECT count(a.id_jurnal) as jumlah FROM jurnal as a where a.tgl between '$tgl1' and '$tgl2'");
        } else {
            $total = DB::selectOne("SELECT count(a.id_jurnal) as jumlah FROM jurnal as a where a.tgl between '$tgl1' and '$tgl2' and a.id_proyek = '$id_proyek'");
        }

        $totalrow = $total->jumlah;


        return Excel::download(new JurnalExport($tgl1, $tgl2, $id_proyek, $totalrow), 'jurnal.xlsx');
    }

    public function edit(Request $r)
    {
        $data =  [
            'title' => 'Jurnal Umum',
            'proyek' => proyek::all(),
            'jurnal' => Jurnal::where('no_nota', $r->no_nota)->get(),
            'akun' => Akun::all(),
            'no_nota' => $r->no_nota,
            'head_jurnal' => DB::selectOne("SELECT a.tgl, a.id_proyek, a.no_dokumen,a.tgl_dokumen, sum(a.debit) as debit , sum(a.kredit) as kredit FROM jurnal as a where a.no_nota = '$r->no_nota'")

        ];
        return view('jurnal.edit', $data);
    }

    public function edit_save(Request $r)
    {
        $tgl = $r->tgl;
        // $no_nota = $r->no_nota;
        $id_akun = $r->id_akun;
        $keterangan = $r->keterangan;
        $debit = $r->debit;
        $kredit = $r->kredit;
        $id_proyek = $r->id_proyek;
        $no_urut = $r->no_urut;
        $nota_t = $r->no_nota;
        $id_post = $r->id_post;

        Jurnal::where('no_nota', $nota_t)->delete();

        for ($i = 0; $i < count($id_akun); $i++) {
            $data = [
                'tgl' => $tgl,
                'no_nota' => $nota_t,
                'id_akun' => $id_akun[$i],
                'id_buku' => '2',
                'ket' => $keterangan[$i],
                'debit' => $debit[$i],
                'kredit' => $kredit[$i],
                'admin' => Auth::user()->name,
                'no_dokumen' => $r->no_dokumen,
                'tgl_dokumen' => $r->tgl_dokumen,
                'id_proyek' => $id_proyek,
                'no_urut' => $no_urut[$i],
                'id_post_center' => $id_post[$i]
            ];
            Jurnal::create($data);
        }
        $tgl1 = date('Y-m-01', strtotime($r->tgl));
        return redirect()->route('jurnal', ['tgl1' => $tgl1, 'tgl2' => $r->tgl, 'id_proyek' => 0])->with('sukses', 'Data berhasil ditambahkan');
    }

    public function detail_jurnal(Request $r)
    {
        $data =  [
            'title' => 'Jurnal Umum',
            'jurnal' => Jurnal::where('no_nota', $r->no_nota)->get(),
            'no_nota' => $r->no_nota,
            'head_jurnal' => DB::selectOne("SELECT a.tgl, b.nm_proyek, a.id_proyek, a.no_dokumen,a.tgl_dokumen, a.no_nota, sum(a.debit) as debit , sum(a.kredit) as kredit FROM jurnal as a 
            left join proyek as b on b.id_proyek = a.id_proyek
            
            where a.no_nota = '$r->no_nota'")

        ];
        return view('jurnal.detail', $data);
    }

    public function import_jurnal()
    {
        Excel::import(new JurnalImport, request()->file('file'));

        return back();
    }

    public function saldo_akun(Request $r)
    {
        $id_akun = $r->id_akun;
        $jurnal =  DB::selectOne("SELECT sum(a.debit) as debit , sum(a.kredit) as kredit FROM jurnal as a where a.id_akun = '$id_akun'");
        $saldo = $jurnal->debit - $jurnal->kredit;

        if (empty($saldo)) {
            $saldo = 'Rp. 0';
        } else {
            $saldo = 'Rp. ' . number_format($saldo, 0, '.', '.');
        }

        $data = [
            'saldo' => $saldo,
        ];
        echo json_encode($data);
    }

    public function get_post(Request $r)
    {
        $id_akun = $r->id_akun;
        $post = DB::table('tb_post_center')->where('id_akun', $id_akun)->get();

        echo "<option value=''>Pilih sub akun</option>";
        foreach ($post as $k) {
            echo "<option value='" . $k->id_post_center  . "'>" . $k->nm_post . "</option>";
        }
    }
}
