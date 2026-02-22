<div class="card-header">
    <h3 class="card-title">Jadwal Mengajar Saya</h3>
</div>

<div style="margin: 20px 0;">
    <p style="color: var(--text-muted); font-size: 14px;">Berikut adalah daftar mata kuliah dan kelas yang Anda ampu pada semester ini.</p>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Mata Kuliah / Kode</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Jadwal (Hari & Jam)</th>
                <th width="120">Status</th>
                <th width="100">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if($jadwal->num_rows() > 0): ?>
                <?php $no=1; foreach ($jadwal->result() as $r) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <div style="font-weight: 700; color: var(--primary);"><?= $r->nama_mk ?></div>
                        <div style="font-size: 11px; color: var(--text-muted);"><?= $r->kode_mk ?></div>
                    </td>
                    <td><span class="badge badge-primary">Kelas <?= $r->nama_kelas ?></span></td>
                    <td>Semester <?= $r->sem_mk ?></td>
                    <td>
                        <div style="font-weight: 700;"><i class="fa-regular fa-calendar-check" style="margin-right: 5px;"></i> <?= $r->hari ?></div>
                        <div style="font-size: 12px;"><i class="fa-regular fa-clock" style="margin-right: 5px;"></i> <?= substr($r->jam_mulai,0,5) ?> - <?= substr($r->jam_selesai,0,5) ?></div>
                    </td>
                    <td>
                        <span class="badge badge-success">AKTIF</span>
                    </td>
                    <td>
                        <a href="<?= base_url('index.php/dosen_fitur/mhs_kelas/'.$r->id_kelas) ?>" class="btn btn-sm" style="background: #f1f5f9; color: #3b82f6; border: 1px solid #dbeafe; padding: 10px 15px; border-radius: 10px;" title="Lihat Mahasiswa">
                            <i class="fa-solid fa-users"></i> Peserta
                        </a>
                    </td>
                </tr>
                <?php } ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 50px; color: var(--text-muted);">
                        <i class="fa-solid fa-calendar-xmark" style="font-size: 40px; margin-bottom: 15px; display: block; opacity: 0.3;"></i>
                        Belum ada jadwal mengajar yang ditugaskan kepada Anda.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
