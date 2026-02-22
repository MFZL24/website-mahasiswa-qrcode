<div class="form-container-card">
    <div class="form-section-title">
        <i class="fa-solid fa-calendar-check"></i> Jadwalkan Pertemuan Baru
    </div>

    <form action="<?= base_url('index.php/pertemuan/tambah') ?>" method="post">
        <div class="input-wrapper">
            <label>Tujuan Kelas Kuliah</label>
            <div class="input-field-container">
                <select name="id_kelas" class="form-control select-pure" required>
                    <option value="">-- Pilih Kelas Aktif --</option>
                    <?php foreach($kelas->result() as $k): ?>
                        <option value="<?= $k->id_kelas ?>">Kelas <?= $k->nama_kelas ?> - <?= $k->nama_mk ?></option>
                    <?php endforeach; ?>
                </select>
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="input-wrapper">
                <label>Pertemuan Ke-</label>
                <div class="input-field-container">
                    <input type="number" name="pertemuan_ke" class="form-control" placeholder="1-16" required min="1" max="16">
                    <i class="fa-solid fa-sort-numeric-up"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Jam Mulai Kuliah</label>
                <div class="input-field-container">
                    <input type="time" name="jam_mulai" class="form-control" required>
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

        <div style="margin-top: 50px; display: flex; gap: 12px; justify-content: flex-end;">
            <a href="<?= base_url('index.php/pertemuan') ?>" class="btn btn-danger" style="background: white; color: #ef4444; border: 2px solid #fecaca; width: 140px; justify-content: center; height: 55px; border-radius: 16px;">Batal</a>
            <button type="submit" name="submit" class="btn btn-primary" style="padding: 0 40px; height: 55px; border-radius: 16px; font-weight: 700;">BUAT JADWAL</button>
        </div>
    </form>
</div>
