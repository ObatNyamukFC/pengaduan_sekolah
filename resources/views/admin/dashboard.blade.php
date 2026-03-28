<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="font-bold text-lg">⚙️ Admin Panel</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-white text-gray-800 text-sm font-semibold px-3 py-1 rounded-lg hover:bg-gray-100">
                Logout
            </button>
        </form>
    </nav>

    <div class="max-w-6xl mx-auto py-8 px-4">

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-lg font-bold text-gray-700 mb-4">📋 Daftar Aspirasi Masuk</h2>

        {{-- Tabel Laporan --}}
        <div class="bg-white rounded-2xl shadow overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b bg-gray-50 text-gray-500">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">NIS</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $i => $l)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $i + 1 }}</td>

                            {{-- Kalau anonim, sembunyikan NIS --}}
                            <td class="px-4 py-3">
                                {{ $l->is_anonim ? '🕵️ Anonim' : $l->nis }}
                            </td>

                            <td class="px-4 py-3">{{ $l->kategori->ket_kategori }}</td>
                            <td class="px-4 py-3">{{ $l->lokasi ?? '-' }}</td>
                            <td class="px-4 py-3 max-w-xs truncate">{{ $l->keterangan ?? '-' }}</td>

                            <td class="px-4 py-3">
                                {{ $l->is_anonim ? 'Ya' : 'Tidak' }}
                            </td>

                            {{-- Badge Status --}}
                            <td class="px-4 py-3">
                                @php $status = $l->detailAspirasi->status ?? 'Menunggu' @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                                    {{ $status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                    {{ $status == 'Proses' ? 'bg-blue-100 text-blue-700' : '' }}
                                                    {{ $status == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}
                                                ">
                                    {{ $status }}
                                </span>
                            </td>

                            {{-- Form Update Status & Feedback --}}
                            <td class="px-4 py-3">
                                <form action="{{ route('admin.update', $l->id_pelaporan) }}" method="POST"
                                    class="flex flex-col gap-2 min-w-[200px]">
                                    @csrf
                                    @method('POST')

                                    <select name="status"
                                        class="border border-gray-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-gray-400">
                                        <option value="Menunggu" {{ ($l->detailAspirasi->status ?? '') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="Proses" {{ ($l->detailAspirasi->status ?? '') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Selesai" {{ ($l->detailAspirasi->status ?? '') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>

                                    <input type="text" name="feedback" value="{{ $l->detailAspirasi->feedback ?? '' }}"
                                        placeholder="Tulis feedback..."
                                        class="border border-gray-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-gray-400">

                                    <button type="submit"
                                        class="bg-gray-800 hover:bg-gray-900 text-white text-xs font-semibold px-3 py-1 rounded-lg transition">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-400">
                                Belum ada aspirasi masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>