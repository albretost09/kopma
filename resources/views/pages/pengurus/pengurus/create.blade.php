<div class="card">
    <div class="card-body p-0">
        <div class="col-md-12">
            <form action="{{ route('pengurus.pengurus.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="pengurus">Email</label>
                    <select class="form-select select2" multiple="multiple" id="pengurus" name="pengurus[]" required>
                        @foreach ($anggota as $item)
                            <option value="{{ $item->id }}">{{ $item->nama . ' - ' . $item->email }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
