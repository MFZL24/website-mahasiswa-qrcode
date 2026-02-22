<div class="card-header">
    <h3 class="card-title"><i class="fa-solid fa-qrcode"></i> Buka Absensi Perkuliahan</h3>
</div>

<div style="padding: 30px;">
    <div style="background: #f0fdf4; border: 1px solid #dcfce7; padding: 20px; border-radius: 15px; margin-bottom: 30px; display: flex; align-items: flex-start; gap: 15px;">
        <i class="fa-solid fa-circle-info" style="color: #16a34a; font-size: 20px; margin-top: 3px;"></i>
        <div>
            <h4 style="color: #166534; font-weight: 700; margin-bottom: 5px;">Cara Mengaktifkan Absensi QR</h4>
            <p style="color: #15803d; font-size: 14px; line-height: 1.6;">
                Pilih kelas yang akan diajarkan, kemudian klik tombol <b>"Lihat Jadwal Pertemuan"</b>. Pada daftar pertemuan, klik <b>"Tampilkan QR"</b> untuk mengaktifkan sesi absensi bagi mahasiswa.
            </p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        <?php foreach($kelas->result() as $k): ?>
        <div class="card" style="border: 1px solid #e2e8f0; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <span class="badge badge-primary">Kelas <?= $k->nama_kelas ?></span>
                <i class="fa-solid fa-graduation-cap" style="color: var(--primary); font-size: 24px;"></i>
            </div>
            <h3 style="font-size: 18px; margin-bottom: 5px; color: var(--text-main);"><?= $k->nama_mk ?></h3>
            <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 25px;">
                <i class="fa-regular fa-calendar-check"></i> Hari: <?= $k->hari ?> | <i class="fa-regular fa-clock"></i> <?= substr($k->jam_mulai,0,5) ?>
            </p>
            <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$k->id_kelas) ?>" class="btn btn-primary" style="width: 100%; justify-content: center; height: 50px; border-radius: 12px;">
                LIHAT JADWAL PERTEMUAN
            </a>
        </div>
        <?php endforeach; ?>
        
        <?php if($kelas->num_rows() == 0): ?>
        <div style="grid-column: 1/-1; text-align: center; padding: 60px; background: #f8fafc; border-radius: 24px; border: 2px dashed #cbd5e1;">
            <i class="fa-solid fa-calendar-xmark" style="font-size: 50px; color: #94a3b8; margin-bottom: 15px; display: block;"></i>
            <p style="color: #64748b; font-weight: 600;">Anda belum memiliki jadwal mengajar semester ini.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
