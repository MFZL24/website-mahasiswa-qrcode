<div class="card-header">
    <h3 class="card-title">Dashboard Dosen</h3>
</div>

<div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 40px; border-radius: 20px; margin-bottom: 35px; position: relative; overflow: hidden;">
    <div style="position: relative; z-index: 2;">
        <h2 style="color: white; margin-bottom: 10px; font-weight: 700;">Selamat Datang, Bapak/Ibu Dosen!</h2>
        <p style="opacity: 0.9; font-size: 16px;">Kelola absensi kelas Anda dengan mudah melalui sistem QR Code.</p>
    </div>
    <i class="fa-solid fa-chalkboard-user" style="position: absolute; right: -20px; bottom: -20px; font-size: 180px; color: rgba(255,255,255,0.1); z-index: 1;"></i>
</div>

<div class="card-header">
    <h3 class="card-title"><i class="fa-solid fa-layer-group"></i> Daftar Kelas Anda</h3>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <?php foreach($kelas->result() as $k): ?>
    <div class="card" style="border: 1px solid #f1f5f9; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); transition: transform 0.2s;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
            <span class="badge badge-primary">Kelas <?= $k->nama_kelas ?></span>
            <i class="fa-solid fa-book" style="color: var(--primary); font-size: 24px;"></i>
        </div>
        <h4 style="margin-bottom: 5px; color: var(--text-main);"><?= $k->nama_mk ?></h4>
        <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 20px;">Semester: <?= $k->semester ?></p>
        <div style="display: flex; gap: 8px;">
            <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$k->id_kelas) ?>" class="btn btn-primary" style="flex: 2; justify-content: center; border-radius: 12px;">
                <i class="fa-solid fa-list-check"></i> Kelola Pertemuan
            </a>
            <a href="<?= base_url('index.php/dosen_fitur/mhs_kelas/'.$k->id_kelas) ?>" class="btn" style="flex: 1; background: #f1f5f9; color: #475569; border-radius: 12px; justify-content: center;" title="Lihat Peserta">
                <i class="fa-solid fa-users"></i>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php if($kelas->num_rows() == 0): ?>
    <div style="grid-column: 1/-1; text-align: center; padding: 50px; background: #f9fafb; border-radius: 20px;">
        <p color="var(--text-muted)">Anda belum memiliki kelas yang diampu.</p>
    </div>
    <?php endif; ?>
</div>