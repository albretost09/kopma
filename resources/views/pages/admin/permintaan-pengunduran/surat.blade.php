<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permohonan Pengunduran Diri</title>
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
            line-height: 2em;
        }

        .text-justify {
            text-indent: 2em !important;
        }

        @include('prints.style')
    </style>
</head>

<body>
    <section class="header-1 mb-3">
        <table class="w-100">
            <tr>
                <td>
                    <div class="row text-center font-16 font-weight-bold">
                        <div>SURAT PERMOHONAN PENGUNDURAN DIRI</div>
                        <div>DARI KEANGGOTAAN KOPERASI MAHASISWA</div>
                        <div>UNIVERSITAS PALANGKA RAYA</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr class="line">
                </td>
            </tr>
        </table>
    </section>

    <section class="body mb-4 mx-auto" style="width: 80%">
        <div class="text-right">Palangka Raya, {{ $pengunduranDiri->tanggal_pengajuan->format('d F Y') }}</div>
        <div class="text-left mb-3">Yang bertanda tangan di bawah ini :</div>
        <table>
            <tr>
                <td style="width: 100px">Nama</td>
                <td style="width: 20px">:</td>
                <td>{{ $pengunduranDiri->pengguna->nama }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>{{ $pengunduranDiri->pengguna->nim }}</td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>{{ $pengunduranDiri->pengguna->jurusan }}</td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>{{ $pengunduranDiri->pengguna->fakultas }}</td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td>{{ $pengunduranDiri->pengguna->no_hp }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $pengunduranDiri->pengguna->email }}</td>
            </tr>
        </table>
        <div class="text-justify mt-3">
            Dengan ini menyampaikan permohonan Pengunduran Diri dari keanggotaan Koperasi Mahasiswa Universitas Palangka
            Raya. Adapun alasan pengunduran diri saya dari keanggotaan Koperasi Mahasiswa UPR yaitu
            {{ $pengunduranDiri->alasan }}.
        </div>
        <div class="text-justify mt-1">
            Sehubungan dengan hal tersebut saya memohon kesediaan pengurus Koperasi Mahasiswa UPR agar simpanan pokok,
            simpanan wajib, dan simpanan sukarela yang merupakan hak saya dapat diberikan sesuai aturan.
        </div>
        <div class="text-justify mt-1">
            Adapun total simpanan pada Koperasi Mahasisiwa berjumlah : Rp.
            {{ number_format($saldo, 2, ',', '.') }}.
        </div>
        <div class="text-justify mt-1">
            Demikian permohonan ini saya sampaikan, atas perhatian dan kerjasamanya saya ucapkan terima kasih.
        </div>

        <section class="footer mt-3">
            <table class="w-100">
                <tr class="text-center">
                    <td>
                        <div class="text-white">Mengetahui</div>
                        <div style="margin-bottom: 100px">Pengurus Kopma</div>
                        <div>……………………</div>
                    </td>
                    <td>
                        <div>Palangka Raya, {{ date('d F Y') }}</div>
                        <div style="margin-bottom: 100px">Pemohon</div>
                        <div class="font-weight-bold">( {{ $pengunduranDiri->pengguna->nama }} )</div>
                    </td>
                </tr>
            </table>
        </section>

        <div class="mt-3">
            <code class="text-danger">*</code>
            untuk pengambilan uang simpanan silahkan dating langsung ke sekretariatan Kopma UPR dengan membawa surat
            ini.
        </div>
</body>
