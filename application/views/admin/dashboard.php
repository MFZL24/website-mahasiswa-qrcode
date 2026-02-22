<div class="card-header">
    <h3 class="card-title">Dashboard Utama Administrator</h3>
</div>

<div style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; padding: 40px; border-radius: 20px; margin-bottom: 35px; position: relative; overflow: hidden;">
    <div style="position: relative; z-index: 2;">
        <h2 style="color: white; margin-bottom: 10px; font-weight: 700;">Selamat Datang, Admin!</h2>
        <p style="opacity: 0.9; font-size: 16px;">Kelola seluruh ekosistem akademik dan monitoring kehadiran dalam satu panel.</p>
    </div>
    <i class="fa-solid fa-shield-halved" style="position: absolute; right: -20px; bottom: -20px; font-size: 180px; color: rgba(255,255,255,0.1); z-index: 1;"></i>
</div>

<!-- Statistik Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 25px; margin-bottom: 40px;">
    <div style="padding: 25px; background: white; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 20px;">
        <div style="width: 60px; height: 60px; background: #eff6ff; color: #3b82f6; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
            <span style="font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Mahasiswa</span>
            <h2 style="margin-top: 5px; color: #1e293b; font-weight: 800;"><?= $total_mhs ?> <small style="font-size: 14px; font-weight: 400; color: #94a3b8;">Aktif</small></h2>
        </div>
    </div>

    <div style="padding: 25px; background: white; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 20px;">
        <div style="width: 60px; height: 60px; background: #ecfdf5; color: #10b981; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <div>
            <span style="font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Dosen</span>
            <h2 style="margin-top: 5px; color: #1e293b; font-weight: 800;"><?= $total_dosen ?> <small style="font-size: 14px; font-weight: 400; color: #94a3b8;">Aktif</small></h2>
        </div>
    </div>

    <div style="padding: 25px; background: white; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 20px;">
        <div style="width: 60px; height: 60px; background: #fefce8; color: #eab308; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            <i class="fa-solid fa-book-open"></i>
        </div>
        <div>
            <span style="font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Mata Kuliah</span>
            <h2 style="margin-top: 5px; color: #1e293b; font-weight: 800;"><?= $total_mk ?> <small style="font-size: 14px; font-weight: 400; color: #94a3b8;">Tersedia</small></h2>
        </div>
    </div>
</div>

<!-- Notifikasi Persetujuan -->
<?php if(count($pending_mhs) > 0 || count($pending_dosen) > 0): ?>
<div class="card-header" style="background: transparent; padding: 0; margin-bottom: 20px;">
    <h3 class="card-title" style="color: #be185d;"><i class="fa-solid fa-bell"></i> Perlu Persetujuan Akun</h3>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 25px;">
    <?php if(count($pending_mhs) > 0): ?>
    <div style="background: #fff1f2; border: 1px solid #fecdd3; border-radius: 20px; padding: 20px;">
        <h4 style="color: #9f1239; margin-bottom: 15px; display: flex; justify-content: space-between;">
            <span><i class="fa-solid fa-user-graduate"></i> Pendaftaran Mahasiswa</span>
            <span class="badge" style="background: #fb7185; color: white;"><?= count($pending_mhs) ?></span>
        </h4>
        <div style="max-height: 200px; overflow-y: auto;">
            <?php foreach($pending_mhs as $pm): ?>
            <div style="background: white; padding: 12px 15px; border-radius: 12px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; border: 1px solid rgba(244, 63, 94, 0.1);">
                <div>
                    <div style="font-weight: 700; font-size: 14px;"><?= $pm->nama ?></div>
                    <div style="font-size: 12px; color: #64748b;">Username: <?= $pm->username ?></div>
                </div>
                <a href="<?= base_url('index.php/mahasiswa/activate/'.$pm->id_operator) ?>" class="btn btn-sm" style="background: #10b981; color: white; padding: 5px 12px; font-size: 11px;">
                    SETUJUI
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if(count($pending_dosen) > 0): ?>
    <div style="background: #fff7ed; border: 1px solid #ffedd5; border-radius: 20px; padding: 20px;">
        <h4 style="color: #9a3412; margin-bottom: 15px; display: flex; justify-content: space-between;">
            <span><i class="fa-solid fa-user-tie"></i> Pendaftaran Dosen</span>
            <span class="badge" style="background: #fb923c; color: white;"><?= count($pending_dosen) ?></span>
        </h4>
        <div style="max-height: 200px; overflow-y: auto;">
            <?php foreach($pending_dosen as $pd): ?>
            <div style="background: white; padding: 12px 15px; border-radius: 12px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; border: 1px solid rgba(249, 115, 22, 0.1);">
                <div>
                    <div style="font-weight: 700; font-size: 14px;"><?= $pd->nama ?></div>
                    <div style="font-size: 12px; color: #64748b;">Username: <?= $pd->username ?></div>
                </div>
                <a href="<?= base_url('index.php/dosen/activate/'.$pd->id_operator) ?>" class="btn btn-sm" style="background: #10b981; color: white; padding: 5px 12px; font-size: 11px;">
                    SETUJUI
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php else: ?>
<div style="background: #f8fafc; border: 2px dashed #e2e8f0; padding: 40px; border-radius: 24px; text-align: center;">
    <i class="fa-solid fa-circle-check" style="font-size: 50px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
    <p style="color: #94a3b8; font-weight: 600;">Semua pendaftaran telah diproses. Tidak ada antrean pending.</p>
</div>
<?php endif; ?>