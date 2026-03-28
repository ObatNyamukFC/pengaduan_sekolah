<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Siswa</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="min-h-screen bg-gray-100">

    
    <nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="font-bold text-lg">📢 Pengaduan Sekolah</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm">NIS: <?php echo e($siswa->nis); ?> | Kelas: <?php echo e($siswa->kelas); ?></span>
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-white text-blue-600 text-sm font-semibold px-3 py-1 rounded-lg hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto py-8 px-4">

        
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="bg-white rounded-2xl shadow p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-4">📝 Sampaikan Aspirasimu</h2>

            <form action="<?php echo e(route('siswa.aspirasi.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="id_kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Kategori --</option>
                        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k->id_kategori); ?>" <?php echo e(old('id_kategori') == $k->id_kategori ? 'selected' : ''); ?>>
                                <?php echo e($k->ket_kategori); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['id_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input 
                        type="text" 
                        name="lokasi" 
                        value="<?php echo e(old('lokasi')); ?>"
                        placeholder="Contoh: Kantin, Kelas X RPL 1"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                    <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea 
                        name="keterangan" 
                        rows="4"
                        placeholder="Ceritakan aspirasi atau keluhanmu..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    ><?php echo e(old('keterangan')); ?></textarea>
                    <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-6 flex items-center gap-2">
                    <input type="checkbox" name="is_anonim" id="is_anonim" class="w-4 h-4">
                    <label for="is_anonim" class="text-sm text-gray-600">Kirim sebagai anonim</label>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                    Kirim Aspirasi
                </button>
            </form>
        </div>

        
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4">📋 Histori Aspirasimu</h2>

            <?php if($histori->isEmpty()): ?>
                <p class="text-gray-400 text-sm text-center py-4">Belum ada aspirasi yang dikirim.</p>
            <?php else: ?>
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
                            <?php $__currentLoopData = $histori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 pr-4"><?php echo e($h->kategori->ket_kategori); ?></td>
                                    <td class="py-2 pr-4"><?php echo e($h->lokasi ?? '-'); ?></td>
                                    <td class="py-2 pr-4">
                                        <?php $status = $h->detailAspirasi->status ?? 'Menunggu' ?>
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                            <?php echo e($status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                                            <?php echo e($status == 'Proses' ? 'bg-blue-100 text-blue-700' : ''); ?>

                                            <?php echo e($status == 'Selesai' ? 'bg-green-100 text-green-700' : ''); ?>

                                        ">
                                            <?php echo e($status); ?>

                                        </span>
                                    </td>
                                    <td class="py-2 text-gray-500"><?php echo e($h->detailAspirasi->feedback ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

    </div>

</body>
</html><?php /**PATH C:\laragon\www\pegaduan_siswa\resources\views/siswa/aspirasi.blade.php ENDPATH**/ ?>