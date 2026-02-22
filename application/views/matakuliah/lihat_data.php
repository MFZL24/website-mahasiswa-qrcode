<div class="card-header" style="justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b;"><i class="fa-solid fa-book-journal-whills" style="color: #10b981;"></i> Kurikulum Mata Kuliah</h3>
        <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Daftar mata kuliah yang tersedia dalam kurikulum program studi.</p>
    </div>
    <a href="<?= base_url('index.php/matakuliah/tambah') ?>" class="btn btn-primary" style="padding: 12px 25px; border-radius: 14px; font-weight: 700; background: #10b981; border: none; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);">
        <i class="fa-solid fa-plus-circle"></i> Tambah Matakuliah
    </a>
</div>

<!-- Grid Layout -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
    <?php 
    $gradients = [
        'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        'linear-gradient(135deg, #10b981 0%, #3b82f6 100%)',
        'linear-gradient(135deg, #f59e0b 0%, #ef4444 100%)',
        'linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%)',
        'linear-gradient(135deg, #06b6d4 0%, #0891b2 100%)',
        'linear-gradient(135deg, #34d399 0%, #059669 100%)'
    ];
    $no=0; foreach ($record->result() as $r): 
        $grad = $gradients[$no % count($gradients)];
        $no++;
    ?>
    <div class="mk-card" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; transition: all 0.3s ease; position: relative;">
        
        <!-- Top Gradient Strip -->
        <div style="height: 10px; background: <?= $grad ?>;"></div>

        <div style="padding: 25px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <div style="width: 45px; height: 45px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #64748b; border: 1px solid #e2e8f0;">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div style="text-align: right;">
                    <span class="badge" style="background: #f1f5f9; color: #475569; font-weight: 700;"><?= $r->kode_mk ?></span>
                    <div style="font-size: 11px; color: #94a3b8; font-weight: 600; margin-top: 4px;">KODE MK</div>
                </div>
            </div>

            <h3 style="margin: 0; font-size: 17px; font-weight: 800; color: #1e293b; line-height: 1.4; min-height: 48px; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 20px;">
                <?= $r->nama_mk ?>
            </h3>

            <div style="display: flex; gap: 10px;">
                <div style="flex: 1; background: #fdf2f8; padding: 10px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 10px; font-weight: 700; color: #db2777; text-transform: uppercase;">Semester</div>
                    <div style="font-size: 15px; font-weight: 800; color: #9d174d;"><?= $r->semester ?></div>
                </div>
                <div style="flex: 1; background: #ecfdf5; padding: 10px; border-radius: 12px; text-align: center;">
                    <div style="font-size: 10px; font-weight: 700; color: #059669; text-transform: uppercase;">Beban SKS</div>
                    <div style="font-size: 15px; font-weight: 800; color: #065f46;"><?= $r->sks ?> SKS</div>
                </div>
            </div>
            
            <div style="margin-top: 25px; display: flex; gap: 10px;">
                <a href="<?= base_url('index.php/matakuliah/edit/'.$r->id_mk) ?>" class="btn btn-sm" style="flex: 1; background: #eff6ff; color: #2563eb; border: none; justify-content: center; font-weight: 700; border-radius: 10px; padding: 10px;">
                    <i class="fa-solid fa-pen-to-square"></i> EDIT
                </a>
                <a href="<?= base_url('index.php/matakuliah/hapus/'.$r->id_mk) ?>" class="btn btn-sm" onclick="return confirm('Hapus data ini?')" style="flex: 1; background: white; color: #94a3b8; border: 1px solid #e2e8f0; justify-content: center; font-weight: 700; border-radius: 10px; padding: 10px;">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if($record->num_rows() == 0): ?>
    <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px; background: #f8fafc; border-radius: 30px; border: 2px dashed #e2e8f0;">
        <i class="fa-solid fa-box-open" style="font-size: 50px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
        <p style="color: #94a3b8; font-weight: 600;">Belum ada data mata kuliah.</p>
    </div>
    <?php endif; ?>
</div>

<style>
.mk-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}
</style>
