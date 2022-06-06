<?php

namespace App\Exports;
use App\Models\User;
use App\Models\Kategori;
use App\Models\PenilaianKinerja;
use App\Models\TotalKinerja;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanKinerjaExport implements FromView, WithStyles, ShouldAutoSize, WithEvents
{
    protected $bulan, $id_karyawan;

    function __construct($bulan, $id_karyawan) {
            $this->id_karyawan = $id_karyawan;
            $this->bulan = $bulan;
    }

    public function view(): View
    {
        $karyawan = User::where('is_active', 1)->get();
        $kategori = Kategori::get();
        $hitung = PenilaianKinerja::where('id_karyawan', $this->id_karyawan)->where('bulan', date('F-Y',strtotime($this->bulan)))->where('is_active', 1)->where('id_kategori',1)->count('id_kinerja');
        $hitung2 = PenilaianKinerja::where('id_karyawan', $this->id_karyawan)->where('bulan', date('F-Y',strtotime($this->bulan)))->where('is_active', 1)->where('id_kategori',2)->count('id_kinerja');
        $kinerja0 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $this->id_karyawan)->where('bulan', date('F-Y',strtotime($this->bulan)))->where('tb_penilaian_kinerja.id_kategori',1)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $kinerja1 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $this->id_karyawan)->where('bulan', date('F-Y',strtotime($this->bulan)))->where('tb_penilaian_kinerja.id_kategori',2)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $kinerja2 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $this->id_karyawan)->where('bulan', date('F-Y',strtotime($this->bulan)))->where('tb_penilaian_kinerja.id_kategori',3)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $totalkinerja = TotalKinerja::where('is_active', 1)->where('bulan', date('F-Y',strtotime($this->bulan)))->where('id_karyawan',$this->id_karyawan)->get();
        $totalkinerjaakhir = TotalKinerja::where('is_active', 1)->where('bulan', date('F-Y',strtotime($this->bulan.'last month')))->where('id_karyawan',$this->id_karyawan)->get();

        $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$this->id_karyawan)->get();

        return view('export-kinerja-karyawan',['karyawan' => $karyawan, 'bio' => $bio, 'totalkinerja' => $totalkinerja, 'totalkinerjaakhir' => $totalkinerjaakhir, 'kategori' => $kategori, 'hitung' => $hitung, 'hitung2' => $hitung2, 'kinerja0' => $kinerja0, 'kinerja1' => $kinerja1, 'kinerja2' => $kinerja2, 'bulan' => $this->bulan]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getRowDimension('38')->setRowHeight(60);
                $event->sheet->getDelegate()->getStyle('38')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            2    => ['font' => ['bold' => true]],
            8    => ['font' => ['bold' => true]],
            'A2'    => ['font' => ['bold' => true]],
            'A17'    => ['font' => ['bold' => true]],
            'A25'    => ['font' => ['bold' => true]],
            34    => ['font' => ['bold' => true]],
            37   => ['font' => ['bold' => true]],
        ];
    }
}
