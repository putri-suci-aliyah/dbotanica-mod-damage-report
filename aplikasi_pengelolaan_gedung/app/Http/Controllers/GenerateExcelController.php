<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use App\Models\Divisi;

class GenerateExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function export(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(50);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(70);
        $sheet->getColumnDimension('L')->setWidth(70);
        
        

        // Add data
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Divisi Asal');

        if ($request->divisi_asal_id == "0") {
            $sheet->setCellValue('C1', 'Semua Divisi');
        }
        else {
            $nama_divisi_asal = Divisi::where('id', $request->divisi_asal_id)->first();
            $sheet->setCellValue('C1', $nama_divisi_asal->nama_divisi);
        }

        $sheet->mergeCells('A2:B2');
        $sheet->setCellValue('A2', 'Divisi Tujuan');

        if ($request->divisi_tujuan_id == "0") {
            $sheet->setCellValue('C2', 'Semua Divisi');
        }
        else{
            $nama_divisi_tujuan = Divisi::where('id', $request->divisi_tujuan_id)->first();
            $sheet->setCellValue('C2', strval($nama_divisi_tujuan->nama_divisi));
        }
        


        $sheet->getStyle('C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->mergeCells('A3:B3');
        $sheet->setCellValue('A3', 'Status');

        if ($request->status_perbaikan == "0") {
            $sheet->setCellValue('C3', 'Semua Status');
        }else{
            $sheet->setCellValue('C3', $request->status_perbaikan);
        }
        
        $sheet->mergeCells('A4:B4');
        $sheet->setCellValue('A4', 'Tanggal Temuan Kerusakan');
        $tanggal_awal_temuan = Carbon::parse($request->tanggal)->locale('id')->translatedFormat('d F Y');
        $sheet->setCellValue('C4', $tanggal_awal_temuan);
        
        $tanggal_akhir_temuan = Carbon::parse($request->tanggal_akhir)->locale('id')->translatedFormat('d F Y');
        $sheet->setCellValue('D4', $tanggal_akhir_temuan);
        
        $headerRange = 'A6:J6';
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle($headerRange)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('FFCCCCCC');

        $sheet->setCellValue('A6', 'No');
        $sheet->setCellValue('B6', 'Nomer Perbaikan');
        $sheet->setCellValue('C6', 'Nama Perbaikan');
        $sheet->setCellValue('D6', 'Lantai');        
        $sheet->setCellValue('E6', 'Divisi Asal');
        $sheet->setCellValue('F6', 'Divisi Tujuan');
        $sheet->setCellValue('G6', 'Temuan');
        $sheet->setCellValue('H6', 'Batas Pengerjaan');
        $sheet->setCellValue('I6', 'Selesai Pengerjaan');
        
        $sheet->setCellValue('J6', 'Status');
        // $sheet->setCellValue('K6', 'Temuan Kerusakan');
        // $sheet->setCellValue('L6', 'Perbaikan');
        
        
        $data_perbaikan = DB::table('perbaikan_gedungs as pg')
            ->join('divisis as dv', 'pg.divisi_asal_id', '=', 'dv.id')
            ->join('divisis as dv2', 'pg.divisi_tujuan_id', '=', 'dv2.id')
            ->select(
                'pg.id',
                'pg.no_perbaikan',
                'pg.nama_perbaikan',
                'pg.lantai',
                'dv.nama_divisi as divisi_asal',
                'dv2.nama_divisi as divisi_tujuan',
                'pg.tanggal_temuan_kerusakan',
                'pg.tanggal_batas_pengerjaan',
                'pg.tanggal_selesai_pengerjaan',
                'pg.status_perbaikan'
            )
            ->when($request->status_perbaikan != "0", function ($query) use ($request) {
                return $query->where('pg.status_perbaikan', $request->status_perbaikan);
            })
            ->when($request->divisi_asal_id != "0", function ($query) use ($request) {
                return $query->where('dv.id', $request->divisi_asal_id);
            })
            ->when($request->divisi_tujuan_id != "0", function ($query) use ($request) {
                return $query->where('dv2.id', $request->divisi_tujuan_id);
            })
            ->whereBetween('pg.tanggal_temuan_kerusakan', [$request->tanggal, $request->tanggal_akhir])
            ->get();

        $startRow = 6;
        $nomer = 0;
        foreach ($data_perbaikan as $item_perbaikan) {

            $startRow++;
            $nomer++;

            $sheet->setCellValue('A' . $startRow, $nomer);
            $sheet->setCellValue('B' . $startRow, $item_perbaikan->no_perbaikan);
            $sheet->setCellValue('C' . $startRow, $item_perbaikan->nama_perbaikan);
            $sheet->setCellValue('D' . $startRow, (string) $item_perbaikan->lantai);
            $sheet->setCellValue('E' . $startRow, $item_perbaikan->divisi_asal);
            $sheet->setCellValue('F' . $startRow, $item_perbaikan->divisi_tujuan);

            $detail_tanggal_temuan = Carbon::parse($item_perbaikan->tanggal_temuan_kerusakan)->locale('id')->translatedFormat('d F Y');
            $sheet->setCellValue('G' . $startRow, $detail_tanggal_temuan);
            
            $detail_tanggal_batas = Carbon::parse($item_perbaikan->tanggal_batas_pengerjaan)->locale('id')->translatedFormat('d F Y');
            $sheet->setCellValue('H' . $startRow, $detail_tanggal_batas);
            
            if ($item_perbaikan->tanggal_selesai_pengerjaan) {
                $detail_selesai = Carbon::parse($item_perbaikan->tanggal_selesai_pengerjaan)
                    ->locale('id')
                    ->translatedFormat('d F Y');
                $sheet->setCellValue('I' . $startRow, $detail_selesai);
            } else {
                $detail_selesai = '-';  // Or whatever default value you want
                $sheet->setCellValue('I' . $startRow, $detail_selesai);
            }
            
            
            $sheet->setCellValue('J' . $startRow, $item_perbaikan->status_perbaikan);

            // $file_temuan_kerusakan_paths = DB::table('detail_temuan_kerusakans')
            //     ->where('perbaikan_gedung_id', $item_perbaikan->id)
            //     ->pluck('file_path');

            // foreach ($file_temuan_kerusakan_paths as $item_filepath) {

            //     $imagePath = public_path($item_filepath); 

            //     $drawing = new Drawing();
            //     $drawing->setName('Sample Image');
            //     $drawing->setDescription('Sample Image Description');
            //     $drawing->setPath($imagePath); 
            //     $drawing->setHeight(300); 
            //     $drawing->setCoordinates('K'.$startRow); 
            //     $drawing->setOffsetX(5); 
            //     $drawing->setOffsetY(5); 

            //     $drawing->setWorksheet($sheet);
            //     $startRow+=20;
            // }

            $sheet->getProtection()->setSheet(true);
            $sheet->getProtection()->setObjects(true);
            
        }
       

        // Save to temporary file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($tempFile);

        return Response::download($tempFile, $filename)->deleteFileAfterSend(true);
    }
}
