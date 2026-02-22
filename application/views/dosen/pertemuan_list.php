<div class="card-header">
    <h3 class="card-title"><i class="fa-solid fa-list-ol"></i> Daftar Pertemuan Kuliah</h3>
    <a href="<?= base_url('index.php/dosen_fitur/tambah_pertemuan/'.$this->uri->segment(3)) ?>" class="btn btn-primary">
        <i class="fa-solid fa-calendar-plus"></i> BUAT SESI BARU
    </a>
</div>

<div style="padding: 20px;">
    <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">Silakan pilih pertemuan yang aktif hari ini untuk menampilkan kode QR absensi.</p>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="80">#</th>
                    <th>Jadwal Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th width="200">Aksi Absensi</th>
                    <th width="60" style="text-align: center;">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pertemuan->result() as $p) { ?>
                <tr>
                    <td><span class="badge badge-primary">PTM <?= $p->pertemuan_ke ?></span></td>
                    <td><div style="font-weight: 700;"><?= date('d F Y', strtotime($p->tanggal)) ?></div></td>
                    <td><i class="fa-regular fa-clock"></i> <?= substr($p->jam_mulai, 0, 5) ?> WIB</td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="<?= base_url('index.php/dosen_fitur/generate_qr/'.$p->id_pertemuan) ?>" class="btn btn-primary btn-sm" style="padding: 10px 15px; border-radius: 10px; flex: 1; justify-content: center;">
                                <i class="fa-solid fa-qrcode"></i> AKTIFKAN QR
                            </a>
                            <a href="<?= base_url('index.php/dosen_fitur/rekap_absensi/'.$p->id_pertemuan) ?>" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; padding: 10px 15px; border-radius: 10px; flex: 1; justify-content: center; font-weight: 700;">
                                <i class="fa-solid fa-users"></i> LIHAT ABSEN
                            </a>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <a href="<?= base_url('index.php/dosen_fitur/hapus_pertemuan/'.$p->id_pertemuan) ?>" class="btn btn-sm" style="background: #fff1f2; color: #e11d48; border: 1px solid #ffe4e6; padding: 6px 12px; border-radius: 8px;" onclick="return confirm('Hapus sesi pertemuan ini? Data absensi di dalamnya juga akan terhapus.')" title="Hapus Sesi">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
                <?php if ($pertemuan->num_rows() == 0): ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 50px; color: var(--text-muted);">
                        <i class="fa-solid fa-calendar-day" style="font-size: 40px; display: block; margin-bottom: 10px; opacity: 0.3;"></i>
                        Belum ada jadwal pertemuan untuk kelas ini. Klik "Buat Sesi Baru" untuk memulai.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px;">
        <a href="<?= base_url('index.php/dashboard') ?>" class="btn btn-edit" style="color: var(--text-main); background: #f1f5f9; border: none;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
