<?php

namespace App\Http\Controllers;

use FPDF;
use App\Models\Kas;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function createPDF()
    {
        $jumlahSHU = (Kas::where('jenis', 'Masuk')->sum('jumlah') - Kas::where('jenis', 'Keluar')->sum('jumlah'));

        $pdf = new FPDF();
        $pdf->AddPage();
        // Arial 15
        $pdf->SetFont('Arial', '', 15);
        // Title
        $pdf->Cell(80);
        $pdf->Cell(30, 10, 'KEMENTERIAN PENDIDIKAN', 0, 0, 'C');
        // Line break
        $pdf->Ln(7);
        $pdf->Cell(80);
        $pdf->Cell(30, 10, 'KEBUDAYAAN, RISET, DAN TEKNOLOGI', 0, 0, 'C');
        // Line break
        $pdf->Ln(7);
        $pdf->Cell(80);
        $pdf->Cell(30, 10, 'UNIVERSITAS PALANGKA RAYA', 0, 0, 'C');
        // Line break
        $pdf->Ln(7);
        $pdf->Cell(80);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(30, 10, 'KOPERASI MAHASISWA', 0, 0, 'C');
        // Line break
        $pdf->Ln(7);

        // Address
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(80);
        $pdf->Cell(30, 10, 'Alamat : Jl. Hendrik Timang', 0, 0, 'C');
        $pdf->Ln(5);
        $pdf->Cell(80);
        $pdf->Cell(30, 10, 'Telepon : 0812-1806-9394/0821-1676-1662', 0, 0, 'C');
        $pdf->Ln(5);
        $pdf->Cell(80);
        $pdf->Cell(30, 10, 'Email/Laman : kopma@upr.ac.id', 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        // Draw line bold
        $pdf->SetLineWidth(1);
        $pdf->Line(10, 58, 200, 58);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(40, 10, 'Laporan SHU');
        // Line break
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 10, 'Tahun');
        $pdf->Cell(10, 10, ':');
        $pdf->Cell(40, 10, date('Y'));
        // Line break
        $pdf->Ln(7);
        $pdf->Cell(30, 10, 'SHU');
        $pdf->Cell(10, 10, ':');
        $pdf->Cell(40, 10, number_format($jumlahSHU, 0, ',', '.'));
        // Line break
        $pdf->Ln(20);

        // Draw line tabel
        $pdf->SetLineWidth(0.2);
        // Set posisi awal tabel
        $pdf->SetXY(33, 100);
        // Arial bold 12
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 7, 'Kebijakan', 1, 0, 'C');
        $pdf->Cell(50, 7, '%', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Jumlah', 1, 1, 'C');

        // Arial 12
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 7, 'Kebijakan', 1, 0, 'C');
        $pdf->Cell(50, 7, '%', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Jumlah', 1, 1, 'C');

        $pdf->Output('Laporan SHU.pdf', 'D');
    }
}
