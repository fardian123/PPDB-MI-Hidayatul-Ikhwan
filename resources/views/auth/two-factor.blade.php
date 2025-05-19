<x-guest-layout>
    <h2 style="font-size: 1.5rem; margin-bottom: 1rem;">Verifikasi Dua Faktor</h2>

    {{-- Notifikasi sukses --}}
    @if (session('status'))
        <div style="color: green; margin-bottom: 1rem;">
            {{ session('status') }}
        </div>
    @endif

    {{-- Error --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Wrapper agar form sejajar --}}
    <div style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
        {{-- Form Verifikasi Kode --}}
        <form method="POST" action="{{ route('two-factor.verify') }}">
            @csrf
            <label for="code">Masukkan Kode Verifikasi:</label><br>
            <input type="text" name="code" id="code" required style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" style="margin-top: 0.5rem; padding: 0.5rem 1rem; background-color: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Verifikasi
            </button>
        </form>

        {{-- Form Kirim Ulang Kode --}}
        <form method="POST" action="{{ route('two-factor.send') }}">
            @csrf
            <button type="submit" style="padding: 0.5rem 1rem; background-color: #10b981; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Kirim Kode Verifikasi
            </button>
        </form>
    </div>
</x-guest-layout>
