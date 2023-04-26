<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kas {{ $tahun }}</title>
    <style type="text/css">
        * {
            font-family: 'Times New Roman', Times, serif;
        }

        .table-bordered {
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
        }

        .table-bordered td {
            border: 0.3pt solid #000 !important;
            padding: 3pt !important;
        }

        .table-bordered th {
            border: 0.3pt solid #000 !important;
            padding: 2pt !important;
        }

        .font-18 {
            font-size: 18pt;
        }

        .font-16 {
            font-size: 16pt;
        }

        .font-14 {
            font-size: 14pt;
        }

        .font-12 {
            font-size: 12pt;
        }

        .header-1 {
            line-height: 1.4;
        }

        .header-1 .line {
            background: black;
            height: 1pt;
        }

        .body {
            font-size: 11pt;
        }

        @include('prints.style')
    </style>
</head>

<body>
    <section class="header-1 mb-3">
        <table class="w-100">
            <tr>
                <td class="text-right">
                    <img src="data:image/png;base64,{{ $logoUPR }}" alt="Logo" class="logo"
                        style="width: 90px; height: 90px; margin-right: 15px">
                </td>
                <td>
                    <div class="row text-center font-16">
                        <div>KEMENTERIAN PENDIDIKAN</div>
                        <div>KEBUDAYAAN, RISET, DAN TEKNOLOGI</div>
                        <div>UNIVERSITAS PALANGKA RAYA</div>
                    </div>
                    <div class="row text-center font-16">
                        <div class="font-weight-bold">KOPERASI MAHASISWA</div>
                    </div>
                    <div class="row text-center font-12">
                        <div>Alamat : Jl. Hendrik Timang</div>
                        <div>Telepon: <i>0812-1806-9394/0821-1676-1662</div></i>
                        <span>Email/Laman : </span><i><a href="mailto:kopma@upr.ac.id">kopma@upr.ac.id</a></i>
                    </div>
                </td>
                <td class="text-left">
                    <img src="data:image/png;base64,{{ $logoKOPMA }}" alt="Logo" class="logo"
                        style="width: 90px; height: 90px; margin-right: 15px">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr class="line">
                </td>
            </tr>
        </table>
    </section>

    <section class="body mb-4">
        <div class="font-weight-bold text-center mb-3">
            <div>BUKU KAS UMUM</div>
            <div>KOPMA UPR</div>
            @if (empty($bulan))
                <div>Tahun: {{ $tahun }}</div>
            @else
                <div>Bulan: {{ $bulan }} {{ $tahun }}</div>
            @endif
        </div>

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalMasuk = 0;
                    $totalKeluar = 0;
                @endphp
                @foreach ($data as $item)
                    @php
                        if ($item->jenis == 'Masuk') {
                            $totalMasuk += $item->jumlah;
                        } else {
                            $totalKeluar += $item->jumlah;
                        }
                    @endphp
                    <tr>
                        <td class="text-center">{{ $item->tanggal_transaksi->format('d F Y') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        @if ($item->jenis == 'Masuk')
                            <td>{{ 'Rp. ' . number_format($item->jumlah, 0, ',', '.') }}</td>
                        @else
                            <td></td>
                        @endif
                        @if ($item->jenis == 'Keluar')
                            <td>{{ 'Rp. ' . number_format($item->jumlah, 0, ',', '.') }}</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-center font-weight-bold">Jumlah Saldo</td>
                    <td class="text-center font-weight-bold">
                        {{ 'Rp. ' . number_format($totalMasuk - $totalKeluar, 0, ',', '.') }}</td>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="footer">
        <table class="w-100">
            <tr>
                <td class="pb-4">Palangka Raya, {{ date('d F Y') }}</td>
            </tr>
            <tr class="text-center">
                <td>
                    <div class="text-white">Mengetahui</div>
                    <div style="margin-bottom: 100px">Ketua</div>
                    <div class="font-weight-bold">Kristianto</div>
                    <div>NIM. BCA 118 101</div>
                </td>
                <td>
                    <div>Mengetahui</div>
                    <div style="margin-bottom: 100px">Pembina</div>
                    <div class="font-weight-bold">Lamria Simamora, SE., MSA., Ak., CA</div>
                    <div>NIP. 19650330 199702 2 002</div>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
