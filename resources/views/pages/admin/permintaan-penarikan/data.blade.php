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
