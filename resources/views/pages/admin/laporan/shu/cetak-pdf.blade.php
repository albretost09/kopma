<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            border: 1px solid #000 !important;
            padding: 3pt !important;
        }

        .table-bordered th {
            border: 1px solid #000 !important;
            padding: 0.5pt !important;
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

        @include('prints.style')
    </style>
</head>

<body>
    <section class="header-1 mb-5">
        <table>
            <td>
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
                <hr class="line">
            </td>
        </table>
    </section>

    <section class="header-2 mb-4">
        <table style="width: 300px" class="mb-5">
            <tr class="font-16 font-weight-bold">
                <td colspan="3">
                    <div class="mb-2">LAPORAN SHU</div>
                </td>
            </tr>
            <tr class="font-14">
                <td>Tahun</td>
                <td>:</td>
                <td>{{ $data['tahun'] }}</td>
            </tr>
            <tr class="font-14">
                <td>Jumlah</td>
                <td>:</td>
                <td>{{ 'Rp. ' . number_format($data['jumlahSHU'], 0, ',', '.') }}</td>
            </tr>
        </table>


        <table class="table table-bordered font-12">
            <thead>
                <tr class="text-center">
                    <th>Kebijakan</th>
                    <th>%</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($SHU as $item)
                    <tr>
                        <td>{{ $item->kebijakan }}</td>
                        <td>{{ $item->persentase }}</td>
                        <td>{{ $item->nominal }}</td>
                    </tr>
                @endforeach
        </table>
    </section>

    <section class="body">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Name</th>
                    <th>Simpanan</th>
                    <th>Penerimaan SHU</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataSHU as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ 'Rp. ' . number_format($item['total_simpanan'], 0, ',', '.') }}</td>
                        <td>{{ 'Rp. ' . number_format($item['shu'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>

</html>
