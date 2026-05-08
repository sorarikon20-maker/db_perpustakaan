<x-app-layout>
    @php $header = 'Pengaturan'; @endphp

    <div>
        {{-- Page Header --}}
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="{{ route('dashboard') }}" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Pengaturan Sistem</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Atur konfigurasi sistem perpustakaan</p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(99,102,241,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Info Banner --}}
        <div style="background:linear-gradient(135deg,#eef2ff,#e0e7ff);border:1px solid #c7d2fe;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p style="font-size:13px;color:#4338ca;margin:0;font-weight:600">Informasi</p>
                <p style="font-size:13px;color:#6366f1;margin:2px 0 0">Nominal denda akan diterapkan otomatis pada semua perhitungan denda keterlambatan pengembalian buku.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('settings.update') }}">
            @csrf

            {{-- Section: Pengaturan Denda --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#f59e0b,#d97706);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        Pengaturan Denda
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group" style="max-width:480px">
                        <label for="denda_per_hari" class="form-label">Nominal Denda Per Hari <span style="color:#ef4444">*</span></label>
                        <div style="position:relative">
                            <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;font-weight:600;color:#64748b">Rp</span>
                            <input type="number" name="denda_per_hari" id="denda_per_hari" 
                                   value="{{ old('denda_per_hari', $dendaPerHari) }}" 
                                   class="form-control" 
                                   style="padding-left:42px;font-size:18px;font-weight:600"
                                   placeholder="5000" min="0" max="1000000" required>
                        </div>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Denda yang dikenakan per hari keterlambatan per buku (dalam Rupiah)</p>
                        @error('denda_per_hari')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Preview --}}
                    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px 20px;margin-top:8px">
                        <p style="font-size:13px;font-weight:600;color:#475569;margin:0 0 8px">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px;display:inline;vertical-align:middle;margin-right:4px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh Perhitungan
                        </p>
                        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px" id="previewGrid">
                            <div style="text-align:center;padding:10px;background:white;border-radius:8px;border:1px solid #e2e8f0">
                                <div style="font-size:12px;color:#94a3b8;margin-bottom:4px">1 hari terlambat</div>
                                <div style="font-size:16px;font-weight:700;color:#0f172a" id="preview1">Rp {{ number_format($dendaPerHari * 1, 0, ',', '.') }}</div>
                            </div>
                            <div style="text-align:center;padding:10px;background:white;border-radius:8px;border:1px solid #e2e8f0">
                                <div style="font-size:12px;color:#94a3b8;margin-bottom:4px">3 hari terlambat</div>
                                <div style="font-size:16px;font-weight:700;color:#f59e0b" id="preview3">Rp {{ number_format($dendaPerHari * 3, 0, ',', '.') }}</div>
                            </div>
                            <div style="text-align:center;padding:10px;background:white;border-radius:8px;border:1px solid #e2e8f0">
                                <div style="font-size:12px;color:#94a3b8;margin-bottom:4px">7 hari terlambat</div>
                                <div style="font-size:16px;font-weight:700;color:#ef4444" id="preview7">Rp {{ number_format($dendaPerHari * 7, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div style="display:flex;gap:12px;justify-content:flex-end;align-items:center">
                <button type="submit" class="btn btn-primary">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('denda_per_hari');

            function formatRupiah(num) {
                return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function updatePreview() {
                const val = parseInt(input.value) || 0;
                document.getElementById('preview1').textContent = formatRupiah(val * 1);
                document.getElementById('preview3').textContent = formatRupiah(val * 3);
                document.getElementById('preview7').textContent = formatRupiah(val * 7);
            }

            input.addEventListener('input', updatePreview);
        });
    </script>
</x-app-layout>
