<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body class="min-h-screen bg-gray-100">

    
    <nav class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="font-bold text-lg">⚙️ Admin Panel</h1>
        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit"
                class="bg-white text-gray-800 text-sm font-semibold px-3 py-1 rounded-lg hover:bg-gray-100">
                Logout
            </button>
        </form>
    </nav>

    <div class="max-w-6xl mx-auto py-8 px-4">

        
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <h2 class="text-lg font-bold text-gray-700 mb-4">📋 Daftar Aspirasi Masuk</h2>

        
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
                    <?php $__empty_1 = true; $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3"><?php echo e($i + 1); ?></td>

                            
                            <td class="px-4 py-3">
                                <?php echo e($l->is_anonim ? '🕵️ Anonim' : $l->nis); ?>

                            </td>

                            <td class="px-4 py-3"><?php echo e($l->kategori->ket_kategori); ?></td>
                            <td class="px-4 py-3"><?php echo e($l->lokasi ?? '-'); ?></td>
                            <td class="px-4 py-3 max-w-xs truncate"><?php echo e($l->keterangan ?? '-'); ?></td>

                            <td class="px-4 py-3">
                                <?php echo e($l->is_anonim ? 'Ya' : 'Tidak'); ?>

                            </td>

                            
                            <td class="px-4 py-3">
                                <?php $status = $l->detailAspirasi->status ?? 'Menunggu' ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                                    <?php echo e($status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                                                    <?php echo e($status == 'Proses' ? 'bg-blue-100 text-blue-700' : ''); ?>

                                                    <?php echo e($status == 'Selesai' ? 'bg-green-100 text-green-700' : ''); ?>

                                                ">
                                    <?php echo e($status); ?>

                                </span>
                            </td>

                            
                            <td class="px-4 py-3">
                                <form action="<?php echo e(route('admin.update', $l->id_pelaporan)); ?>" method="POST"
                                    class="flex flex-col gap-2 min-w-[200px]">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('POST'); ?>

                                    <select name="status"
                                        class="border border-gray-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-gray-400">
                                        <option value="Menunggu" <?php echo e(($l->detailAspirasi->status ?? '') == 'Menunggu' ? 'selected' : ''); ?>>Menunggu</option>
                                        <option value="Proses" <?php echo e(($l->detailAspirasi->status ?? '') == 'Proses' ? 'selected' : ''); ?>>Proses</option>
                                        <option value="Selesai" <?php echo e(($l->detailAspirasi->status ?? '') == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
                                    </select>

                                    <input type="text" name="feedback" value="<?php echo e($l->detailAspirasi->feedback ?? ''); ?>"
                                        placeholder="Tulis feedback..."
                                        class="border border-gray-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-gray-400">

                                    <button type="submit"
                                        class="bg-gray-800 hover:bg-gray-900 text-white text-xs font-semibold px-3 py-1 rounded-lg transition">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-400">
                                Belum ada aspirasi masuk.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html><?php /**PATH C:\laragon\www\pegaduan_siswa\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>