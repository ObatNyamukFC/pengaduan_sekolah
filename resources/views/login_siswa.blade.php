<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">

        {{-- Logo / Judul --}}
        <h1 class="text-2xl font-bold text-center text-blue-600 mb-2">Pengaduan Sekolah</h1>
        <p class="text-center text-gray-500 mb-6">Masuk sebagai Siswa</p>

        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form Login --}}
        <form action="{{ route('login.siswa.proses') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                <input type="number" name="nis" placeholder="Masukkan NIS kamu" value="{{ old('nis') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                Masuk
            </button>
        </form>

        {{-- Link ke login admin --}}
        <p class="text-center text-sm text-gray-400 mt-4">
            Kamu admin? <a href="/login-admin" class="text-blue-500 hover:underline">Login di sini</a>
        </p>

    </div>

</body>

</html>