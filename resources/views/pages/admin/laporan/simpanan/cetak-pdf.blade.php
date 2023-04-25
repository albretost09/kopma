<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Simpanan {{ $tahun }}</title>
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
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Simpanan Pokok</th>
                    <th rowspan="2">Simpanan Sukarela</th>
                    <th colspan="12">Simpanan Wajib</th>
                    <th rowspan="2">Jumlah Jasa Modal</th>
                </tr>
                <tr class="text-center">
                    <th>Januari</th>
                    <th>Februari</th>
                    <th>Maret</th>
                    <th>April</th>
                    <th>Mei</th>
                    <th>Juni</th>
                    <th>Juli</th>
                    <th>Agustus</th>
                    <th>September</th>
                    <th>Oktober</th>
                    <th>November</th>
                    <th>Desember</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['simpanan_pokok'] ? 'Rp. ' . number_format($item['simpanan_pokok'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_sukarela'] ? 'Rp. ' . number_format($item['simpanan_sukarela'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['februari'] ? 'Rp. ' . number_format($item['simpanan_wajib']['januari'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['februari'] ? 'Rp. ' . number_format($item['simpanan_wajib']['februari'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['maret'] ? 'Rp. ' . number_format($item['simpanan_wajib']['maret'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['april'] ? 'Rp. ' . number_format($item['simpanan_wajib']['april'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['mei'] ? 'Rp. ' . number_format($item['simpanan_wajib']['mei'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['juni'] ? 'Rp. ' . number_format($item['simpanan_wajib']['juni'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['juli'] ? 'Rp. ' . number_format($item['simpanan_wajib']['juli'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['agustus'] ? 'Rp. ' . number_format($item['simpanan_wajib']['agustus'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['september'] ? 'Rp. ' . number_format($item['simpanan_wajib']['september'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['oktober'] ? 'Rp. ' . number_format($item['simpanan_wajib']['oktober'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['november'] ? 'Rp. ' . number_format($item['simpanan_wajib']['november'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['simpanan_wajib']['desember'] ? 'Rp. ' . number_format($item['simpanan_wajib']['desember'], 0, ',', '.') : null }}
                        </td>
                        <td>{{ $item['jumlah_jasa_modal'] ? 'Rp. ' . number_format($item['jumlah_jasa_modal'], 0, ',', '.') : null }}
                        </td>
                    </tr>
                @endforeach
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
