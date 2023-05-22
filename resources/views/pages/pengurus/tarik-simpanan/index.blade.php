@extends('layouts.admin')

@section('content')
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header d-flex justify-content-between">
                <div>
                    <h3>Tarik Simpanan</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('dashboard') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tarik Simpanan</li>
                        </ol>
                    </nav>
                </div>
                <div class="text-xs">
                    <h6 class="mb-0">Saldo Simpanan</h6>
                    <h3 class="mb-0">Rp. {{ number_format($saldoSimpanan, 0, ',', '.') }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('pengurus.tarik-simpanan.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Tarik Simpanan</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-pills mb-3" role="tablist">
                                                    <li class="nav-item w-100 text-center">
                                                        <label class="nav-link active" id="transfer-tab" data-toggle="pill"
                                                            role="tab" aria-controls="transfer"
                                                            aria-selected="false">Transfer</label>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="jenis_transaksi" value="Transfer">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Jumlah</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="jumlah_penarikan" class="form-control">
                                                        <span
                                                            class="text-danger">{{ $errors->first('jumlah_penarikan') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row transfer">
                                                    <label class="col-sm-2 col-form-label">Bank Tujuan</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-select select2" id="bank_tujuan"
                                                            name="bank_tujuan">
                                                            <option value="">Pilih Bank</option>
                                                        </select>
                                                        <span class="text-danger">{{ $errors->first('bank_tujuan') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row transfer">
                                                    <label class="col-sm-2 col-form-label">No. Rekening</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nomor_rekening" class="form-control">
                                                        <span
                                                            class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nama Pemilik Rekening</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nama_pemilik" class="form-control">
                                                        <span
                                                            class="text-danger">{{ $errors->first('nama_pemilik') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (count($bankTujuanTersimpan) > 0)
                                    <h4>Bank Tujuan Tersimpan</h4>
                                    <div class="row">
                                        @foreach ($bankTujuanTersimpan as $item)
                                            <div class="col-md-3">
                                                <a href="#" onclick="isiValue(this)">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <input type="hidden" name="bank_tujuan_value"
                                                                value="{{ $item->bank_tujuan }}">
                                                            <input type="hidden" name="nomor_rekening_value"
                                                                value="{{ $item->nomor_rekening }}">
                                                            <input type="hidden" name="nama_pemilik_value"
                                                                value="{{ $item->nama_pemilik }}">

                                                            <h6>{{ $item->nama_pemilik }}</h6>
                                                            @php
                                                                $bank = strtoupper($item->bank_tujuan);
                                                                $bank = str_replace('_', ' ', $bank);
                                                            @endphp
                                                            <span>{{ $bank }}: </span>
                                                            <span>{{ $item->nomor_rekening }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="text-center">
                                    <button class="btn btn-primary">TARIK</button>
                                </div>
                                <div class="alert alert-warning my-4">
                                    Proses penarikan simpanan akan diproses dalam waktu 1x24 jam.
                                </div>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h6 class="card-title">Kontak Admin</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    Silahkan hubungi admin jika terjadi kesalahan.
                                                </div>
                                                <div class="mt-3">
                                                    <a href="https://api.whatsapp.com/send?phone={{ $whatsappAdmin }}&text=Halo%20Admin%20Saya%20Mau%20Tanya%20Tentang%20Tarik%20Simpanan%20Pengurus%20{{ auth()->user()->nama }}"
                                                        class="btn btn-success btn-sm" target="_blank">
                                                        <i class="fa fa-whatsapp"></i>
                                                        <span class="ml-2">Hubungi Admin</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- ./ Content -->

        @include('includes.admin.footer')
    </div>
    <!-- ./ Content body -->
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/vendors/select2/css/select2.min.css') }}" type="text/css">
    <style>
        .nav-pills .nav-link {
            border: 1px solid #f4f5fd !important;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('backend/vendors/select2/js/select2.min.js') }}"></script>
    <script>
        function isiValue(e) {
            var bank_tujuan = $(e).find('input[name="bank_tujuan_value"]').val();
            var nomor_rekening = $(e).find('input[name="nomor_rekening_value"]').val();
            var nama_pemilik = $(e).find('input[name="nama_pemilik_value"]').val();

            $('select[name="bank_tujuan"]').val(bank_tujuan).trigger('change');
            $('input[name="nomor_rekening"]').val(nomor_rekening);
            $('input[name="nama_pemilik"]').val(nama_pemilik);
        }

        // Mendapatkan elemen dropdown
        const bank_tujuan = document.getElementById('bank_tujuan');

        const data = {
            "data": [{
                    "name": "Bank Mandiri",
                    "code": "mandiri"
                },
                {
                    "name": "Bank Rakyat Indonesia",
                    "code": "bri"
                },
                {
                    "name": "BNI (Bank Negara Indonesia)",
                    "code": "bni"
                },
                {
                    "name": "Bank Central Asia",
                    "code": "bca"
                },
                {
                    "name": "BSI (Bank Syariah Indonesia)",
                    "code": "bsm"
                },
                {
                    "name": "CIMB Niaga & CIMB Niaga Syariah",
                    "code": "cimb"
                },
                {
                    "name": "Muamalat",
                    "code": "muamalat"
                },
                {
                    "name": "Bank Danamon & Danamon Syariah",
                    "code": "danamon"
                },
                {
                    "name": "Bank Permata & Permata Syariah",
                    "code": "permata"
                },
                {
                    "name": "Maybank Indonesia",
                    "code": "bii"
                },
                {
                    "name": "Panin Bank",
                    "code": "panin"
                },
                {
                    "name": "TMRW/UOB",
                    "code": "uob"
                },
                {
                    "name": "OCBC NISP",
                    "code": "ocbc"
                },
                {
                    "name": "Citibank",
                    "code": "citibank"
                },
                {
                    "name": "Bank Artha Graha Internasional",
                    "code": "artha"
                },
                {
                    "name": "Bank of Tokyo Mitsubishi UFJ",
                    "code": "tokyo"
                },
                {
                    "name": "DBS Indonesia",
                    "code": "dbs"
                },
                {
                    "name": "Standard Chartered Bank",
                    "code": "standard_chartered"
                },
                {
                    "name": "Bank Capital Indonesia",
                    "code": "capital"
                },
                {
                    "name": "ANZ Indonesia",
                    "code": "anz"
                },
                {
                    "name": "Bank of China (Hong Kong) Limited",
                    "code": "boc"
                },
                {
                    "name": "Bank Bumi Arta",
                    "code": "bumi_arta"
                },
                {
                    "name": "HSBC Indonesia",
                    "code": "hsbc"
                },
                {
                    "name": "Rabobank International Indonesia",
                    "code": "rabobank"
                },
                {
                    "name": "Bank Mayapada",
                    "code": "mayapada"
                },
                {
                    "name": "BJB",
                    "code": "bjb"
                },
                {
                    "name": "Bank DKI Jakarta",
                    "code": "dki"
                },
                {
                    "name": "BPD DIY",
                    "code": "daerah_istimewa"
                },
                {
                    "name": "Bank Jateng",
                    "code": "jawa_tengah"
                },
                {
                    "name": "Bank Jatim",
                    "code": "jawa_timur"
                },
                {
                    "name": "Bank Jambi",
                    "code": "jambi"
                },
                {
                    "name": "Bank Sumut",
                    "code": "sumut"
                },
                {
                    "name": "Bank Sumbar (Bank Nagaragara)",
                    "code": "sumatera_barat"
                },
                {
                    "name": "Bank Riau Kepri",
                    "code": "riau_dan_kepri"
                },
                {
                    "name": "Bank Sumsel Babel",
                    "code": "sumsel_dan_babel"
                },
                {
                    "name": "Bank Lampung",
                    "code": "lampung"
                },
                {
                    "name": "Bank Kalsel",
                    "code": "kalimantan_selatan"
                },
                {
                    "name": "Bank Kalbar",
                    "code": "kalimantan_barat"
                },
                {
                    "name": "Bank Kaltim",
                    "code": "kalimantan_timur"
                },
                {
                    "name": "Bank Kalteng",
                    "code": "kalimantan_tengah"
                },
                {
                    "name": "Bank Sulselbar",
                    "code": "sulselbar"
                },
                {
                    "name": "Bank SulutGo",
                    "code": "sulut"
                },
                {
                    "name": "Bank NTB Syariah",
                    "code": "nusa_tenggara_barat"
                },
                {
                    "name": "BPD Bali",
                    "code": "bali"
                },
                {
                    "name": "Bank NTT",
                    "code": "nusa_tenggara_timur"
                },
                {
                    "name": "Bank Maluku",
                    "code": "maluku"
                },
                {
                    "name": "Bank Papua",
                    "code": "papua"
                },
                {
                    "name": "Bank Bengkulu",
                    "code": "bengkulu"
                },
                {
                    "name": "Bank Sulteng",
                    "code": "sulawesi"
                },
                {
                    "name": "Bank Sultra",
                    "code": "sulawesi_tenggara"
                },
                {
                    "name": "Bank Nusantara Parahyangan",
                    "code": "nusantara_parahyangan"
                },
                {
                    "name": "Bank of India Indonesia",
                    "code": "india"
                },
                {
                    "name": "Bank Mestika Dharma",
                    "code": "mestika_dharma"
                },
                {
                    "name": "Bank Sinarmas",
                    "code": "sinarmas"
                },
                {
                    "name": "Bank Maspion Indonesia",
                    "code": "maspion"
                },
                {
                    "name": "Bank Ganesha",
                    "code": "ganesha"
                },
                {
                    "name": "ICBC Indonesia",
                    "code": "icbc"
                },
                {
                    "name": "QNB Indonesia",
                    "code": "qnb_kesawan"
                },
                {
                    "name": "BTN/BTN Syariah",
                    "code": "btn"
                },
                {
                    "name": "Bank Woori Saudara",
                    "code": "woori"
                },
                {
                    "name": "BTPN",
                    "code": "tabungan_pensiunan_nasional"
                },
                {
                    "name": "Bank BTPN Syariah",
                    "code": "btpn_syr"
                },
                {
                    "name": "BJB Syariah",
                    "code": "bjb_syr"
                },
                {
                    "name": "Bank Mega",


                    "code": "mega"
                },
                {
                    "name": "Wokee/Bukopin",
                    "code": "bukopin"
                },
                {
                    "name": "Bank Bukopin Syariah",
                    "code": "bukopin_syr"
                },
                {
                    "name": "Bank Jasa Jakarta",
                    "code": "jasa_jakarta"
                },
                {
                    "name": "LINE Bank/KEB Hana",
                    "code": "hana"
                },
                {
                    "name": "Motion/MNC Bank",
                    "code": "mnc_internasional"
                },
                {
                    "name": "BRI Agroniaga",
                    "code": "agroniaga"
                },
                {
                    "name": "SBI Indonesia",
                    "code": "sbi_indonesia"
                },
                {
                    "name": "Blu/BCA Digital",
                    "code": "royal"
                },
                {
                    "name": "Nobu (Nationalnobu) Bank",
                    "code": "nationalnobu"
                },
                {
                    "name": "Bank Mega Syariah",
                    "code": "mega_syr"
                },
                {
                    "name": "Bank Ina Perdana",
                    "code": "ina_perdana"
                },
                {
                    "name": "Bank Sahabat Sampoerna",
                    "code": "sahabat_sampoerna"
                },
                {
                    "name": "Seabank/Bank BKE",
                    "code": "kesejahteraan_ekonomi"
                },
                {
                    "name": "BCA (Bank Central Asia) Syariah",
                    "code": "bca_syr"
                },
                {
                    "name": "Jago/Artos",
                    "code": "artos"
                },
                {
                    "name": "Bank Mayora Indonesia",
                    "code": "mayora"
                },
                {
                    "name": "Bank Index Selindo",
                    "code": "index_selindo"
                },
                {
                    "name": "Bank Victoria International",
                    "code": "victoria_internasional"
                },
                {
                    "name": "Bank IBK Indonesia",
                    "code": "agris"
                },
                {
                    "name": "CTBC (Chinatrust) Indonesia",
                    "code": "chinatrust"
                },
                {
                    "name": "Commonwealth Bank",
                    "code": "commonwealth"
                },
                {
                    "name": "Bank Victoria Syariah",
                    "code": "victoria_syr"
                },
                {
                    "name": "BPD Banten",
                    "code": "banten"
                },
                {
                    "name": "Bank Mutiara",
                    "code": "mutiara"
                },
                {
                    "name": "Panin Dubai Syariah",
                    "code": "panin_syr"
                },
                {
                    "name": "Bank Aceh Syariah",
                    "code": "aceh"
                },
                {
                    "name": "Bank Antardaerah",
                    "code": "antardaerah"
                },
                {
                    "name": "Bank China Construction Bank Indonesia",
                    "code": "ccb"
                },
                {
                    "name": "Bank CNB (Centratama Nasional Bank)",
                    "code": "cnb"
                },
                {
                    "name": "Bank Dinar Indonesia",
                    "code": "dinar"
                },
                {
                    "name":

                        "Bank Ekonomi Raharja",
                    "code": "ekonomi"
                },
                {
                    "name": "Bank Ganesha Syariah",
                    "code": "ganesha_syr"
                },
                {
                    "name": "Bank Hagakita",
                    "code": "hagakita"
                },
                {
                    "name": "Bank Harda Internasional",
                    "code": "harda"
                },
                {
                    "name": "Bank ICB Bumiputera",
                    "code": "icb_bumiputera"
                },
                {
                    "name": "Bank INA",
                    "code": "ina"
                },
                {
                    "name": "Bank Jasa Surabaya",
                    "code": "jasa_surabaya"
                },
                {
                    "name": "Bank KEB Hana Syariah",
                    "code": "hana_syr"
                },
                {
                    "name": "Bank Kesejahteraan Ekonomi Syariah",
                    "code": "kesejahteraan_ekonomi_syr"
                },
                {
                    "name": "Bank Lampung Syariah",
                    "code": "lampung_syr"
                },
                {
                    "name": "Bank Maspion Syariah",
                    "code": "maspion_syr"
                },
                {
                    "name": "Bank Mayora Syariah",
                    "code": "mayora_syr"
                },
                {
                    "name": "Bank Naga",
                    "code": "naga"
                },
                {
                    "name": "Bank Nationalnobu Syariah",
                    "code": "nationalnobu_syr"
                },
                {
                    "name": "Bank OCBC NISP Syariah",
                    "code": "ocbc_syr"
                },
                {
                    "name": "Bank Pefindo",
                    "code": "pefindo"
                },
                {
                    "name": "Bank Permata Syariah",
                    "code": "permata_syr"
                },
                {
                    "name": "Bank QNB Indonesia Syariah",
                    "code": "qnb_kesawan_syr"
                },
                {
                    "name": "Bank Rabobank International Indonesia",
                    "code": "rabobank_internasional"
                },
                {
                    "name": "Bank Sahabat Purba Danarta",
                    "code": "sahabat_purba_danarta"
                },
                {
                    "name": "Bank Sampoerna",
                    "code": "sampoerna"
                },
                {
                    "name": "Bank Sejahtera Indonesia",
                    "code": "sejahtera"
                },
                {
                    "name": "Bank Syariah Indonesia (BSI)",
                    "code": "bsi_syr"
                },
                {
                    "name": "Bank Victoria Internasional Syariah",
                    "code": "victoria_internasional_syr"
                },
                {
                    "name": "Bank Yudha Bhakti",
                    "code": "yudha_bhakti"
                },
                {
                    "name": "Bank DKI Syariah",
                    "code": "dki_syr"
                },
                {
                    "name": "BPD Aceh",
                    "code": "aceh_daerah"
                },
                {
                    "name": "BPD Jambi",
                    "code": "jambi_daerah"
                },
                {
                    "name": "BPD Jawa Timur",


                    "code": "jawa_timur_daerah"
                },
                {
                    "name": "BPD Jawa Tengah",
                    "code": "jawa_tengah_daerah"
                },
                {
                    "name": "BPD Jawa Barat",
                    "code": "jawa_barat_daerah"
                },
                {
                    "name": "BPD Sumatera Utara",
                    "code": "sumatera_utara_daerah"
                },
                {
                    "name": "BPD Sumatera Barat",
                    "code": "sumatera_barat_daerah"
                },
                {
                    "name": "BPD Riau Kepri",
                    "code": "riau_dan_kepri_daerah"
                },
                {
                    "name": "BPD Sumsel Babel",
                    "code": "sumsel_dan_babel_daerah"
                },
                {
                    "name": "BPD Lampung",
                    "code": "lampung_daerah"
                },
                {
                    "name": "BPD Kalsel",
                    "code": "kalimantan_selatan_daerah"
                },
                {
                    "name": "BPD Kalbar",
                    "code": "kalimantan_barat_daerah"
                },
                {
                    "name": "BPD Kaltim",
                    "code": "kalimantan_timur_daerah"
                },
                {
                    "name": "BPD Kalteng",
                    "code": "kalimantan_tengah_daerah"
                },
                {
                    "name": "BPD Sulselbar",
                    "code": "sulselbar_daerah"
                },
                {
                    "name": "BPD Sulut",
                    "code": "sulut_daerah"
                },
                {
                    "name": "BPD NTB",
                    "code": "nusa_tenggara_barat_daerah"
                },
                {
                    "name": "BPD Bali",
                    "code": "bali_daerah"
                },
                {
                    "name": "BPD NTT",
                    "code": "nusa_tenggara_timur_daerah"
                },
                {
                    "name": "BPD Maluku",
                    "code": "maluku_daerah"
                },
                {
                    "name": "BPD Papua",
                    "code": "papua_daerah"
                },
                {
                    "name": "BPD Bengkulu",
                    "code": "bengkulu_daerah"
                },
                {
                    "name": "BPD Sulawesi",
                    "code": "sulawesi_daerah"
                },
                {
                    "name": "BPD Sulawesi Tenggara",
                    "code": "sulawesi_tenggara_daerah"
                },
                {
                    "name": "Bank DKI",
                    "code": "dki_daerah"
                },
                {
                    "name": "Bank BJB",
                    "code": "bjb_daerah"
                },
                {
                    "name": "Bank BJB Syariah",
                    "code": "bjb_syr_daerah"
                },
                {
                    "name": "Bank Jatim",
                    "code": "jatim_daerah"
                },
                {
                    "name": "Bank Jatim Syariah",
                    "code": "jatim_syr_daerah"
                },
                {
                    "name": "Bank Jateng",
                    "code": "jateng_daerah"
                },
                {
                    "name": "Bank Jateng Syariah ",
                    "code": "jateng_syr_daerah"
                },
                {
                    "name": "Bank Jabar Banten Syariah",
                    "code": "jabar_banten_syr_daerah"
                },
                {
                    "name": "Bank Sumut",
                    "code": "sumut_daerah"
                },
                {
                    "name": "Bank Sumselbabel",
                    "code": "sumselbabel_daerah"
                },
                {
                    "name": "Bank Riau Kepri",
                    "code": "riau_kepri_daerah"
                },
                {
                    "name": "Bank Kalbar",
                    "code": "kalbar_daerah"
                },
                {
                    "name": "Bank Kalteng",
                    "code": "kalteng_daerah"
                },
                {
                    "name": "Bank Kaltimtara",
                    "code": "kaltimtara_daerah"
                },
                {
                    "name": "Bank Sulselbar",
                    "code": "sulselbar_daerah"
                },
                {
                    "name": "Bank SulutGo",
                    "code": "sulut_daerah"
                },
                {
                    "name": "Bank NTB",
                    "code": "ntb_daerah"
                },
                {
                    "name": "Bank Bali",
                    "code": "bali_daerah"
                },
                {
                    "name": "Bank NTT",
                    "code": "ntt_daerah"
                },
                {
                    "name": "Bank Maluku",
                    "code": "maluku_daerah"
                },
                {
                    "name": "Bank Papua",
                    "code": "papua_daerah"
                }
            ]
        }

        const dataArray = data.data;

        // Mengisi dropdown dengan data
        dataArray.forEach(function(bank) {
            const option = document.createElement('option');
            option.value = bank.code;
            option.text = bank.name;
            bank_tujuan.appendChild(option);
        });

        $('.select2').select2({
            allowClear: true,
        });

        $('input[name="jumlah_penarikan"]').on('keyup', function() {
            var value = $(this).val();
            var rupiah = value.replace(/[^0-9]/g, '');
            var rupiah = rupiah.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            $(this).val(rupiah);
        });

        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            showDuration: 200,
            hideDuration: 200
        };

        @if (session()->has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session()->has('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@endpush
