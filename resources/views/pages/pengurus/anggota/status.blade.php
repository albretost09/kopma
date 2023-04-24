<div class="card">
    <div class="card-body p-0">
        <form action="{{ route('pengurus.anggota.ubah-status', $anggota->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Status</span>
                </div>
                <select class="form-control" name="status">
                    <option value="AKTIF" {{ $anggota->status == 'AKTIF' ? 'selected' : '' }}>Aktif</option>
                    <option value="NONAKTIF" {{ $anggota->status == 'NONAKTIF' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
