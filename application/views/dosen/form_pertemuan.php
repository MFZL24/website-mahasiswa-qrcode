<div class="form-container-card" style="max-width: 600px; margin: 0 auto;">
    <div class="form-section-title">
        <i class="fa-solid fa-calendar-plus"></i> Tambah Sesi Perkuliahan
    </div>

    <div style="background: #eff6ff; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #dbeafe; display: flex; align-items: center; gap: 15px;">
        <i class="fa-solid fa-graduation-cap" style="color: #3b82f6; font-size: 20px;"></i>
        <div>
            <div style="font-size: 11px; font-weight: 800; color: #3b82f6; text-transform: uppercase;">Mata Kuliah / Kelas</div>
            <div style="font-weight: 800; color: #1e40af;"><?= $kelas->nama_mk ?> (<?= $kelas->nama_kelas ?>)</div>
        </div>
    </div>

    <form action="<?= base_url('index.php/dosen_fitur/simpan_pertemuan') ?>" method="post">
        <input type="hidden" name="id_kelas" value="<?= $kelas->id_kelas ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="input-wrapper">
                <label>Pertemuan Ke-</label>
                <div class="input-field-container">
                    <input type="number" name="pertemuan_ke" class="form-control" value="<?= $next_ptm ?>" required min="1" max="16">
                    <i class="fa-solid fa-sort-numeric-up"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Jam Mulai</label>
                <div class="input-field-container">
                    <input type="time" name="jam_mulai" class="form-control" value="<?= date('H:i') ?>" required>
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
        </div>
        
        <div class="input-wrapper">
            <label>Tanggal Pelaksanaan</label>
            <div class="input-field-container">
                <input type="date" name="tanggal" class="form-control" required value="<?= date('Y-m-d') ?>">
                <i class="fa-solid fa-calendar-day"></i>
            </div>
        </div>

        <div style="margin-top: 40px; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$kelas->id_kelas) ?>" class="btn btn-danger" style="background: #f1f5f9; color: #475569; border: none; padding: 12px 25px; border-radius: 12px; font-weight: 700;">Batal</a>
            <button type="submit" name="submit" class="btn btn-primary" style="padding: 12px 30px; border-radius: 12px; font-weight: 800; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">SIMPAN SESI</button>
        </div>
    </form>
</div>
