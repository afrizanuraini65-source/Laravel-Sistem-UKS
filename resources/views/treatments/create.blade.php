<x-app-layout>
<x-slot name="header">Input Kunjungan Baru</x-slot>

<div style="margin-bottom:22px;">
    <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Catat Kunjungan Siswa</h1>
    <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Silakan isi formulir di bawah untuk mencatat data kunjungan UKS</p>
</div>

@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<div class="card" style="max-width:800px; padding:28px;">
    <form action="{{ route('treatments.store') }}" method="POST">
        @csrf
        
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label" for="student_id">Pilih Siswa</label>
                <select name="student_id" id="student_id" class="form-control" required>
                    <option value="">-- Cari Nama/NIS --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->nis }} - {{ $student->nama }} ({{ $student->kelas->nama_kelas ?? '-' }})
                        </option>
                    @endforeach
                </select>
                @error('student_id') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="tanggal">Tanggal Kunjungan</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="form-control" required>
                @error('tanggal') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="keluhan">Keluhan Utama</label>
            <textarea name="keluhan" id="keluhan" rows="3" class="form-control" placeholder="Jelaskan apa yang dirasakan siswa..." required>{{ old('keluhan') }}</textarea>
            @error('keluhan') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="diagnosa">Diagnosa / Tindakan (Opsional)</label>
            <textarea name="diagnosa" id="diagnosa" rows="2" class="form-control" placeholder="Misal: Istirahat di UKS, kompres hangat...">{{ old('diagnosa') }}</textarea>
        </div>

        <div style="background:#f8faff; border:1px dashed #cbd5e1; border-radius:12px; padding:20px; margin-top:10px; margin-bottom:24px;">
            <h3 style="font-size:0.85rem; font-weight:700; color:#1d4ed8; margin-bottom:15px; display:flex; align-items:center; gap:8px;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                Berikan Obat (Pilih jika perlu)
            </h3>
            
            <div id="medicine-rows">
                <div class="medicine-row" style="display:flex; gap:12px; margin-bottom:10px; align-items:start;">
                    <div style="flex:1;">
                        <select name="medicines[]" class="form-control">
                            <option value="">-- Pilih Obat --</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->nama_obat }} (Stok: {{ $medicine->stok }} {{ $medicine->satuan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="width:100px;">
                        <input type="number" name="quantities[]" placeholder="Qty" min="1" class="form-control">
                    </div>
                    <button type="button" class="remove-row btn btn-danger btn-sm" style="height:41px; padding:0 12px;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>
            
            <button type="button" id="add-medicine" class="btn btn-secondary btn-sm" style="margin-top:5px; color:#1d4ed8; font-weight:700;">
                + Tambah Jenis Obat
            </button>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:12px; border-top:1px solid #f1f5f9; padding-top:24px;">
            <a href="{{ route('treatments.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding-left:30px; padding-right:30px;">
                Simpan Catatan Kunjungan
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-medicine').addEventListener('click', function() {
        const rows = document.getElementById('medicine-rows');
        const firstRow = rows.querySelector('.medicine-row');
        const newRow = firstRow.cloneNode(true);
        
        // Reset values
        newRow.querySelectorAll('input, select').forEach(input => input.value = '');
        rows.appendChild(newRow);
        
        // Attach remove event to the new button
        attachRemoveEvent(newRow.querySelector('.remove-row'));
    });

    function attachRemoveEvent(button) {
        button.addEventListener('click', function() {
            const allRows = document.querySelectorAll('.medicine-row');
            if (allRows.length > 1) {
                this.closest('.medicine-row').remove();
            } else {
                // If only one row, just clear it
                this.closest('.medicine-row').querySelectorAll('input, select').forEach(input => input.value = '');
            }
        });
    }

    // Initial attach
    document.querySelectorAll('.remove-row').forEach(button => attachRemoveEvent(button));
</script>
</x-app-layout>
