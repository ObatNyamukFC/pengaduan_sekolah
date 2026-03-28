<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-800 flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">

        {{-- Judul --}}
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">Admin Panel</h1>
        <p class="text-center text-gray-500 mb-6">Masuk sebagai Administrator</p>

        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form Login --}}
        <form action="{{ route('login.admin.proses') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="Masukkan password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
            </div>

            <button type="submit"
                class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 rounded-lg transition">
                Masuk
            </button>
        </form>

        {{-- Link balik ke login siswa --}}
        <p class="text-center text-sm text-gray-400 mt-4">
            Bukan admin? <a href="/" class="text-blue-500 hover:underline">Login sebagai Siswa</a>
        </p>

    </div>

</body>

</html>