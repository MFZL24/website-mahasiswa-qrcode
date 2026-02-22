<div class="card-header">
    <h3 class="card-title">Dashboard Mahasiswa</h3>
</div>

<div style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; padding: 40px; border-radius: 20px; margin-bottom: 35px; position: relative; overflow: hidden;">
    <div style="position: relative; z-index: 2;">
        <h2 style="color: white; margin-bottom: 10px; font-weight: 700;">Halo, <?= $mhs->nama ?>!</h2>
        <p style="opacity: 0.9; font-size: 16px; margin-bottom: 25px;">NIM: <b><?= $mhs->nim ?></b> | <?= $mhs->prodi ?></p>
        <a href="<?= base_url('index.php/mhs_fitur/scan') ?>" class="btn" style="background: white; color: #4f46e5; padding: 12px 25px; border-radius: 12px; font-weight: 700;">
            <i class="fa-solid fa-qrcode"></i> SCAN KEHADIRAN SEKARANG
        </a>
    </div>
    <i class="fa-solid fa-user-graduate" style="position: absolute; right: -20px; bottom: -20px; font-size: 180px; color: rgba(255,255,255,0.1); z-index: 1;"></i>
</div>

<div class="card-header">
    <h3 class="card-title"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Kehadiran Anda</h3>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Mata Kuliah</th>
                <th>Ptm Ke</th>
                <th>Tanggal</th>
                <th>Waktu Absen</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($riwayat->result() as $r) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td style="font-weight: 600;"><?= $r->nama_mk ?></td>
                <td><span class="badge badge-primary">Ptm <?= $r->pertemuan_ke ?></span></td>
                <td><?= date('d M Y', strtotime($r->tanggal)) ?></td>
                <td><i class="fa-regular fa-clock"></i> <?= date('H:i', strtotime($r->waktu_absen)) ?> WIB</td>
                <td>
                    <?php 
                        $status_class = ($r->status == 'Hadir') ? 'badge-success' : 'badge-danger';
                    ?>
                    <span class="badge <?= $status_class ?>"><?= $r->status ?></span>
                </td>
            </tr>
            <?php } ?>
            <?php if($riwayat->num_rows() == 0): ?>
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted);">
                    <i class="fa-solid fa-calendar-xmark" style="font-size: 40px; display: block; margin-bottom: 10px; opacity: 0.3;"></i>
                    Belum ada riwayat absensi.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>