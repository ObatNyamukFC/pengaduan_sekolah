<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Siswa</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="font-bold text-lg">📢 Pengaduan Sekolah</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm">NIS: {{ $siswa->nis }} | Kelas: {{ $siswa->kelas }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white text-blue-600 text-sm font-semibold px-3 py-1 rounded-lg hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto py-8 px-4">

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Input Aspirasi --}}
        <div class="bg-white rounded-2xl shadow p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-4">📝 Sampaikan Aspirasimu</h2>

            <form action="{{ route('siswa.aspirasi.store') }}" method="POST">
                @csrf

                {{-- Kategori --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="id_kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input 
                        type="text" 
                        name="lokasi" 
                        value="{{ old('lokasi') }}"
                        placeholder="Contoh: Kantin, Kelas X RPL 1"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                    @error('lokasi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea 
                        name="keterangan" 
                        rows="4"
                        placeholder="Ceritakan aspirasi atau keluhanmu..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Anonim --}}
                <div class="mb-6 flex items-center gap-2">
                    <input type="checkbox" name="is_anonim" id="is_anonim" class="w-4 h-4">
                    <label for="is_anonim" class="text-sm text-gray-600">Kirim sebagai anonim</label>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                    Kirim Aspirasi
                </button>
            </form>
        </div>

        {{-- Histori Aspirasi --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4">📋 Histori Aspirasimu</h2>

            @if($histori->isEmpty())
                <p class="text-gray-400 text-sm text-center py-4">Belum ada aspirasi yang dikirim.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b text-gray-500">
                                <th class="py-2 pr-4">Kategori</th>
                                <th class="py-2 pr-4">Lokasi</th>
                                <th class="py-2 pr-4">Status</th>
                                <th class="py-2">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histori as $h)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 pr-4">{{ $h->kategori->ket_kategori }}</td>
                                    <td class="py-2 pr-4">{{ $h->lokasi ?? '-' }}</td>
                                    <td class="py-2 pr-4">
                                        @php $status = $h->detailAspirasi->status ?? 'Menunggu' @endphp
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                            {{ $status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $status == 'Proses' ? 'bg-blue-100 text-blue-700' : '' }}
                                            {{ $status == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}
                                        ">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="py-2 text-gray-500">{{ $h->detailAspirasi->feedback ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>

</body>
</html>