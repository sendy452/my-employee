<?php

namespace App\Exports;
use App\Models\User;
use App\Models\Divisi;
use App\Models\PenilaianKeahlian;
use App\Models\TotalKeahlian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanKeahlianExport implements FromView, WithStyles, ShouldAutoSize, WithEvents
{
    protected $bulan, $id_karyawan, $id_divisi;

    function __construct($bulan, $id_karyawan, $id_divisi) {
            $this->id_karyawan = $id_karyawan;
            $this->bulan = $bulan;
            $this->id_divisi = $id_divisi;
    }

    public function view(): View
    {
        $karyawan = User::where('is_active', 1)->get();
        $divisi = Divisi::get();
        $penilaiankeahlian = PenilaianKeahlian::leftJoin('tb_keahlian', 'tb_penilaian_keahlian.id_keahlian', '=', 'tb_keahlian.id_keahlian')
        ->where('tb_penilaian_keahlian.id_divisi', $this->id_divisi)->where('id_karyawan', $this->id_karyawan)->where('bulan', date('F-Y',strtotime($this->bulan)))->where('id_karyawan',$this->id_karyawan)->orderBy('tb_penilaian_keahlian.id_keahlian', 'asc')->get();
        $totalkeahlian = TotalKeahlian::where('id_divisi', $this->id_divisi)->where('is_active', 1)->where('bulan', date('F-Y',strtotime($this->bulan)))->where('id_karyawan',$this->id_karyawan)->get();
        $totalkeahlianakhir = TotalKeahlian::where('id_divisi', $this->id_divisi)->where('is_active', 1)->where('bulan', date('F-Y',strtotime($this->bulan.'last month')))->where('id_karyawan',$this->id_karyawan)->get();
        $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$this->id_karyawan)->get();

        return view('export-keahlian-karyawan', ['karyawan' => $karyawan, 'bio' => $bio, 'penilaiankeahlian' => $penilaiankeahlian, 'totalkeahlian' => $totalkeahlian, 'id_dv' => $this->id_divisi, 'totalkeahlianakhir' => $totalkeahlianakhir, 'bulan' => $this->bulan, 'divisi' => $divisi]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getRowDimension('19')->setRowHeight(60);
                $event->sheet->getDelegate()->getStyle('19')
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
            15    => ['font' => ['bold' => true]],
            17   => ['font' => ['bold' => true]],
        ];
    }
}
